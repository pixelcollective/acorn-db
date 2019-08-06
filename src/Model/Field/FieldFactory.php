<?php

namespace TinyPixel\Acorn\Database\Model\Field;

use Illuminate\Support\Collection;
use TinyPixel\Acorn\Database\Model\Model;
use TinyPixel\Acorn\Database\Model\Field\Text;
use TinyPixel\Acorn\Database\Model\Field\Image;
use TinyPixel\Acorn\Database\Model\Field\Repeater;

/**
 * Field factory
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Field
 **/
class FieldFactory
{
    /**
     * Constructor.
     *
     * @return null
     **/
    private function __construct()
    {
        // ---
    }

    /**
     * Make field based on type.
     *
     * @param  string $name
     * @param  Model $post
     * @param  null|string $type
     * @return FieldInterface|Collection|string
     **/
    public static function make(string $name, Model $post, $type = null)
    {
        /**
         * Determine field type if none set
         */
        if ($type === null) {
            $fakeText = new Text($post);

            /**
             * Return null if field is non-existent
             */
            if ($key = $fakeText->fetchFieldKey($name) === null) {
                return null;
            }

            $type = $fakeText->fetchFieldType($key);
        }

        switch ($type) {
            /**
             * Text fields
             */
            case 'text':
            case 'textarea':
            case 'number':
            case 'email':
            case 'url':
            case 'link':
            case 'password':
            case 'wysiwyg':
            case 'editor':
            case 'oembed':
            case 'embed':
            case 'color_picker':
            case 'select':
            case 'checkbox':
            case 'radio':
                $field = new Text($post);
                break;

            /**
             * Image fields
             */
            case 'image':
            case 'img':
                $field = new Image($post);
                break;

            /**
             * Repeater field
             */
            case 'repeater':
                $field = new Repeater($post);
                break;

            /**
             * Fallback
             */
            default:
                return null;
        }

        return $field->process($name);
    }
}
