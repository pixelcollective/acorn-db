<?php

namespace TinyPixel\AcornDB\Model\Field;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;
use TinyPixel\AcornDB\Model\Field\Field;
use TinyPixel\AcornDB\Model\Field\FieldInterface;
use TinyPixel\AcornDB\Model\Model\Post;
use TinyPixel\AcornDB\Model\Meta\TermMeta;

/**
 * Repeater Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Field
 **/
class Repeater extends Field implements FieldInterface
{
    /**
     * Fields.
     *
     * @var Collection
     */
    protected $fields;

    /**
     * Process field.
     *
     * @param  string $fieldName
     * @return void
     **/
    public function process($fieldName) : void
    {
        $this->name = $fieldName;

        $builder = $this->fetchPostsMeta($fieldName, $this->post);
        $fields  = $this->fetchFields($fieldName, $builder);

        $this->fields = new Collection($fields);
    }

    /**
     * Getter.
     *
     * @return Collection
     **/
    public function get() : Collection
    {
        return $this->fields;
    }

    /**
     * Get a field id from its name
     *
     * @param  string $metaKey
     * @param  string $fieldName
     * @return int
     **/
    protected function retrieveIdFromFieldName($metaKey, $fieldName) : int
    {
        return (int) str_replace("{$fieldName}_", '', $metaKey);
    }

    /**
     * Get a field name.
     *
     * @param  string $metaKey
     * @param  string $fieldName
     * @param  int    $id
     * @return string
     **/
    protected function retrieveFieldName(string $metaKey, string $fieldName, int $id) : string
    {
        $pattern = "{$fieldName}_{$id}_";

        return str_replace($pattern, '', $metaKey);
    }

    /**
     * Get post meta.
     *
     * @param string $fieldName
     * @param Post   $post
     *
     * @return mixed
     **/
    protected function fetchPostsMeta(string $fieldName, Post $post)
    {
        $count = (int) $this->fetchValue($fieldName);

        if ($this->postMeta instanceof TermMeta) {
            $builder = $this->postMeta->where('term_id', $post->term_id);
        } else {
            $builder = $this->postMeta->where('post_id', $post->ID);
        }

        $builder->where(function ($query) use ($count, $fieldName) {
            foreach (range(0, $count - 1) as $i) {
                $query->orWhere('meta_key', 'like', "{$fieldName}_{$i}_%");
            }
        });

        return $builder;
    }

    /**
     * Get fields.
     *
     * @param  string $fieldName
     * @param  Builder $builder
     * @return mixed
     **/
    protected function fetchFields($fieldName, Builder $builder)
    {
        $fields = [];

        foreach ($builder->get() as $meta) {
            $id   = $this->retrieveIdFromFieldName($meta->meta_key, $fieldName);
            $name = $this->retrieveFieldName($meta->meta_key, $fieldName, $id);
            $post = $this->post->ID != $meta->post_id ?
                    $this->post->find($meta->post_id) :
                    $this->post;

            $field = FieldFactory::make($meta->meta_key, $post);

            if ($field == null) {
                continue;
            }

            $fields[$id][$name] = $field->get();
        }

        return $fields;
    }
}
