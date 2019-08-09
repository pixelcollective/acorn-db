<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\Post;

/**
 * Attachment Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 **/
class Attachment extends Post
{
    /**
     * Specify a posttype.
     *
     * @var string
     **/
    protected $postType = 'attachment';

    /**
     * Alias column names.
     *
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     *
     * @var array
     */
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
     *
     * @return BelongsTo
     **/
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
