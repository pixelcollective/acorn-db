<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Attachment;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Taxonomy;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Model\Traits\HasMeta;
use TinyPixel\Acorn\Database\Model\Relationship\TermRelationship;

/**
 * Post Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Post extends WordPress
{
    use HasMeta;

    /** @var string */
    const CREATED_AT = 'post_date';

    /** @var string */
    const UPDATED_AT = 'post_modified';

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'posts';

    /** @var string */
    protected $primaryKey = 'ID';

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     */
    protected $maps = [
        'id'        => 'ID',
        'date'      => 'post_date',
        'date_gmt'  => 'post_date_gmt',
        'title'     => 'post_title',
        'status'    => 'post_status',
        'modified'  => 'post_modified',
        'parent'    => 'post_parent',
        'type'      => 'post_type',
        'mime_type' => 'post_mime_type',
        'content'   => 'post_content',
        'excerpt'   => 'post_excerpt',
        'comments'  => 'comment_count',
        'password'  => 'post_password',
        'url'       => 'guid',
    ];

    /**
     * Post thumbnail.
     *
     * @return HasOne
     */
    public function thumbnail() : HasOne
    {
        return $this->hasOne(ThumbnailMeta::class, 'post_id')
                    ->where('meta_key', '_thumbnail_id');
    }

    /**
     * A post has one author.
     *
     * @return Post $this
     */
    public function author()
    {
        return $this->hasOne(User::class, 'ID', 'post_author');
    }

    /**
     * A post is related to many meta fields.
     */
    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    /**
     * A post has many terms found through the TermRelationship model.
     *
     * @return HasManyThrough
     */
    public function terms()
    {
        return $this->hasManyThrough(
            Taxonomy::class,
            Relationship::class,
            'object_id',
            'term_taxonomy_id'
        );
    }

    public function categories()
    {
        return $this->terms()->where('taxonomy', 'category');
    }

    public function tags()
    {
        return $this->terms()->where('taxonomy', 'post_tag');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'post_parent', 'ID')
                    ->where('post_type', 'attachment');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_post_ID');
    }

    public function scopeType($query, $type = 'post')
    {
        return $query->where('post_type', $type);
    }

    public function scopeStatus($query, $status = null)
    {
        return $query->where('post_status', $status);
    }

    public function scopePublished($query)
    {
        return $query->where('post_status', 'publish');
    }

    public function scopeDraft($query)
    {
        return $query->where('post_status', 'draft');
    }
}
