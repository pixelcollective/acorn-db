<?php
namespace AcornDB\ACF;

use Illuminate\Support\Collection;
use AcornDB\Model\Model;
use AcornDB\ACF\Field\Boolean;
use AcornDB\ACF\Field\DateTime;
use AcornDB\ACF\Field\File;
use AcornDB\ACF\Field\Gallery;
use AcornDB\ACF\Field\Image;
use AcornDB\ACF\Field\PageLink;
use AcornDB\ACF\Field\PostObject;
use AcornDB\ACF\Field\Repeater;
use AcornDB\ACF\Field\FlexibleContent;
use AcornDB\ACF\Field\Select;
use AcornDB\ACF\Field\Term;
use AcornDB\ACF\Field\Text;
use AcornDB\ACF\Field\User;

/**
 * Class FieldFactory.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class FieldFactory
{
    private function __construct()
    {
    }

    /**
     * @param string $name
     * @param Post $post
     * @param null|string $type
     *
     * @return FieldInterface|Collection|string
     */
    public static function make($name, Model $post, $type = null)
    {
        if (null === $type) {
            $fakeText = new Text($post);
            $key = $fakeText->fetchFieldKey($name);

            if ($key === null) { // Field does not exist
                return null;
            }

            $type = $fakeText->fetchFieldType($key);
        }


        switch ($type) {
            case 'text':
                // Intentional fallthrough
            case 'textarea':
                // Intentional fallthrough
            case 'number':
                // Intentional fallthrough
            case 'email':
                // Intentional fallthrough
            case 'url':
                // Intentional fallthrough
            case 'link':
                // Intentional fallthrough
            case 'password':
                // Intentional fallthrough
            case 'wysiwyg':
                // Intentional fallthrough
            case 'editor':
                // Intentional fallthrough
            case 'oembed':
                // Intentional fallthrough
            case 'embed':
                // Intentional fallthrough
            case 'color_picker':
                // Intentional fallthrough
            case 'select':
                // Intentional fallthrough
            case 'checkbox':
                // Intentional fallthrough
            case 'radio':
                $field = new Text($post);
                break;
            case 'image':
                // Intentional fallthrough
            case 'img':
                $field = new Image($post);
                break;
            case 'file':
                $field = new File($post);
                break;
            case 'gallery':
                $field = new Gallery($post);
                break;
            case 'true_false':
                // Intentional fallthrough
            case 'boolean':
                $field = new Boolean($post);
                break;
            case 'post_object':
                // Intentional fallthrough
            case 'post':
                // Intentional fallthrough
            case 'relationship':
                $field = new PostObject($post);
                break;
            case 'page_link':
                $field = new PageLink($post);
                break;
            case 'taxonomy':
                // Intentional fallthrough
            case 'term':
                $field = new Term($post);
                break;
            case 'user':
                $field = new User($post);
                break;
            case 'date_picker':
                // Intentional fallthrough
            case 'date_time_picker':
                // Intentional fallthrough
            case 'time_picker':
                $field = new DateTime($post);
                break;
            case 'repeater':
                $field = new Repeater($post);
                break;
            case 'flexible_content':
                $field = new FlexibleContent($post);
                break;
            default:
                return null;
        }

        $field->process($name);

        return $field;
    }
}
