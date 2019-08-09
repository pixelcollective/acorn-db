<?php

namespace TinyPixel\AcornDB\Model\Field;

use Illuminate\Database\Eloquent\Collection;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\Model\Meta\PostMeta;
use TinyPixel\AcornDB\Model\Field\Field;
use TinyPixel\AcornDB\Model\Field\FieldInterface;

/**
 * Image Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Field
 */
class Image extends Field implements FieldInterface
{
    /**
     * Image width.
     *
     * @var int
     */
    public $width;

    /**
     * Image height.
     *
     * @var int
     */
    public $height;

    /**
     * Image filename.
     *
     * @var string
     */
    public $filename;

    /**
     * Image description.
     *
     * @var string
     */
    public $description;

    /**
     * Image Url.
     *
     * @var string
     */
    public $url;

    /**
     * Image mime type.
     *
     * @var string
     */
    public $mime_type;

    /**
     * Image sizes.
     *
     * @var string
     */
    protected $sizes = [];

    /**
     * @var bool
     */
    protected $loadFromPost = false;

    /**
     * Process field.
     *
     * @param  string $field
     * @return void
     */
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
     */
    public function get() : Image
    {
        return $this;
    }

    /**
     * Fill fields.
     *
     * @param  Post $attachment
     * @return void
     */
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
     */
    public function size($size, $useOriginalFallback = false) : Image
    {
        if (isset($this->sizes[$size])) {
            return $this->fillThumbnailFields($this->sizes[$size]);
        }

        return ! $useOriginalFallback
               ? $this->fillThumbnailFields($this->sizes['thumbnail'])
               : $this;
    }

    /**
     * Fill thumbnail fields.
     *
     * @param  array $data
     * @return Image
     */
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
     * @param  Post  $postAttachment
     * @return array
     */
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
     */
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
     */
    protected function fillMetadataFields(array $imageData) : void
    {
        $this->filename = basename($imageData['file']);
        $this->width    = $imageData['width'];
        $this->height   = $imageData['height'];
        $this->sizes    = $imageData['sizes'];
    }
}
