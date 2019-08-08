<?php

namespace TinyPixel\Acorn\Database\Model\Field;

use TinyPixel\Acorn\Database\Model\Model;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Term;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Model\Meta\TermMeta;
use TinyPixel\Acorn\Database\Model\Meta\UserMeta;

/**
 * Abstract Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Field
 */
abstract class Field
{
    /** @var Model **/
    protected $post;

    /** @var PostMeta **/
    protected $postMeta;

    /** @var string  **/
    protected $name;

    /** @var string */
    protected $key;

    /** @var string */
    protected $type;

    /** @var mixed **/
    protected $value;

    /**
     * Constructor.
     *
     * @param Post $post
     **/
    public function __construct(Model $post)
    {
        $this->post = $post;

        switch (true) {
            case $post instanceof Post:
                $this->postMeta = new PostMeta();
                break;
            case $post instanceof Term:
                $this->postMeta = new TermMeta();
                break;
            case $post instanceof User:
                $this->postMeta = new UserMeta();
                break;
        }
    }

    /**
     * Get the value of a field using the post id.
     *
     * @param  string $field
     * @return array|string
     **/
    public function fetchValue($field)
    {
        $postMeta = $this->postMeta->where($this->getKeyName(), $this->post->getKey())
                         ->where('meta_key', $field)
                         ->first();

        if (isset($postMeta->meta_value) && !is_null($postMeta->meta_value)) {
            $value = $postMeta->meta_value;

            if ($array = @unserialize($value) && is_array($array)) {
                return $this->value = $value;
            }

            return $this->value = $value;
        }
    }

    /**
     * Get the key of a field using the field's name.
     *
     * @param  string $fieldName
     * @return string
     **/
    public function fetchFieldKey($fieldName) : string
    {
        $this->name = $fieldName;

        if ($this->postMeta
            ->where($this->getKeyName(), $this->post->getKey())
            ->where('meta_key', '_' . $this->name)
            ->first()) {
            return $this->key = $postMeta->meta_value;
        }

        return null;
    }

    /**
     * Get field type using the field's key.
     *
     * @param  string $fieldKey
     * @return string|null
     **/
    public function fetchFieldType($fieldKey)
    {
        if ($post = Post::where(function ($query) use ($fieldKey) {
            $query->where('post_name', $fieldKey);
            $query->where('post_type', 'acf-field');
        })->first()) {
            $type  = unserialize($post->post_content)['type'];

            return $this->type = isset($type) ? $type : 'text';
        }

        return null;
    }

    /**
     * Get the name of the key for the field.
     *
     * @return string
     **/
    public function getKeyName() : string
    {
        switch (true) {
            case $this->post instanceof Post:
                return 'post_id';
            case $this->post instanceof Term:
                return 'term_id';
            case $this->post instanceof User:
                return 'user_id';
        }
    }

    /**
     * Return string
     *
     * @return mixed
     **/
    public function __toString()
    {
        return $this->get();
    }
}
