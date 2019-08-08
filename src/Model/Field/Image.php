<?php
namespace TinyPixel\Acorn\Database\Model\Field;

use Illuminate\Database\Eloquent\Collection;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Model\Field\Field;
use TinyPixel\Acorn\Database\Model\Field\FieldInterface;

/**
 * Image Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @version    1.0.0
 * @package    Acorn\Database
 * @subpackage Model\Field
 * @implements TinyPixel\Acorn\Database\Model\Field\FieldInterface
 * @extends    TinyPixel\Acorn\Database\Model\Field\Field
 **/
class Image extends Field implements FieldInterface
{
    /** @var int */
    public $width;

    /** @var int */
    public $height;

    /** @var string */
    public $filename;

    /** @var string */
    public $description;

    /** @var string */
    public $url;

    /** @var string */
    public $mime_type;

    /** @var string */
    protected $sizes = [];

    /** @var bool */
    protected $loadFromPost = false;

    /**
     * Process field.
     *
     * @uses   Post
     * @param  string $field
     * @return void
     **/
    public function process(string $field) : void
    {
        $attachmentId = $this->fetchValue($field);

        if ($attachment = Post::on($connection)->find(intval($attachmentId))) {
            $this->fillFields($attachment);
            $this->fillMetadataFields($this->fetchMetadataValue($attachment));
        }
    }

    /**
     * Getter.
     *
     * @return Image
     **/
    public function get() : Image
    {
        return $this;
    }

    /**
     * Fill fields.
     *
     * @param  Post $attachment
     * @return void
     **/
    protected function fillFields(Post $attachment) : void
    {
        $this->attachment  = $attachment;
        $this->mime_type   = $attachment->post_mime_type;
        $this->url         = $attachment->guid;
        $this->description = $attachment->post_excerpt;
    }

    /**
     * Get image size.
     *
     * @param string $size
     * @param bool   $useOriginalFallback
     *
     * @return Image
     **/
    public function size($size, $useOriginalFallback = false) : Image
    {
        if (isset($this->sizes[$size])) {
            return $this->fillThumbnailFields($this->sizes[$size]);
        }

        return  ! $useOriginalFallback
                ? $this->fillThumbnailFields($this->sizes['thumbnail'])
                : $this;
    }

    /**
     * Fill thumbnail fields.
     *
     * @param  array $data
     * @return Image
     **/
    protected function fillThumbnailFields(array $data) : Image
    {
        $image = new static($this->post);

        $image->filename  = $data['file'];
        $image->width     = $data['width'];
        $image->height    = $data['height'];
        $image->mime_type = $data['mime-type'];
        $image->url       = sprintf('%s/%s', dirname($this->url), $image->filename);

        return $image;
    }

    /**
     * Get metadata from post attachment.
     *
     * @param  Post $postAttachment
     * @return array
     **/
    protected function fetchMetadataValue(Post $postAttachment)
    {
        $meta = PostMeta::where('post_id', $postAttachment->ID)
                        ->where('meta_key', '_wp_attachment_metadata')
                        ->first();

        return unserialize($meta->meta_value);
    }

    /**
     * Collect metadata from multiple post attachments.
     *
     * @param  Collection $attachments
     * @return {Collection|array}
     **/
    protected function fetchMultipleMetadataValues(Collection $attachments)
    {
        $metadataValues = [];

        $postMeta = PostMeta::whereIn("post_id", $attachments->pluck('ID')->toArray())
                            ->where('meta_key', '_wp_attachment_metadata')
                            ->get();

        Collection::make($postMeta)->each(function ($meta) use (&$metadataValues) {
            $metadataValues[$meta->post_id] = unserialize($meta->meta_value);
        });

        return $metadataValues;
    }

    /**
     * Add metadata fields to model using arrayed image data.
     *
     * @param  array $imageData
     * @return void
     **/
    protected function fillMetadataFields(array $imageData) : void
    {
        $this->filename = basename($imageData['file']);
        $this->width    = $imageData['width'];
        $this->height   = $imageData['height'];
        $this->sizes    = $imageData['sizes'];
    }
}
