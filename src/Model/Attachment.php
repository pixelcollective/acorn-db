<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\WordPress;

/**
 * Attachment Model
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 * @uses    Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model\Attachment
 **/
class Attachment extends WordPress
{
    /** @var string */
    protected $postType = 'attachment';

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     **/
    protected $maps = [
        'title'       => 'post_title',
        'url'         => 'guid',
        'type'        => 'post_mime_type',
        'description' => 'post_content',
        'caption'     => 'post_excerpt',
        'alt'         => ['meta' => '_wp_attachment_image_alt'],
    ];

    /**
     * Attachments belong to posts.
     * @return BelongsTo
     **/
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
