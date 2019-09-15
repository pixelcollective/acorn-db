<?php

namespace TinyPixel\AcornDB\ACF\Field;

use Illuminate\Support\Collection;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\ACF\FieldInterface;

/**
 * Class Term.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Term extends BasicField implements FieldInterface
{
    /**
     * @var mixed
     */
    protected $items;

    /**
     * @var \TinyPixel\AcornDB\Model\Term
     */
    protected $term;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
        $this->term = new \TinyPixel\AcornDB\Model\Term();
        $this->term->setConnection($post->getConnectionName());
    }

    /**
     * @param string $fieldName
     */
    public function process($fieldName)
    {
        $value = $this->fetchValue($fieldName);
        if (is_array($value)) {
            $this->items = $this->term->whereIn('term_id', $value)->get(); // ids
        } else {
            $this->items = $this->term->find(intval($value));
        }
    }

    /**
     * @return Term|Collection
     */
    public function get()
    {
        return $this->items; // Collection or Term object
    }
}
