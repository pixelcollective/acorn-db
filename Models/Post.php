<?php

namespace App\Models;

use App\Models\User;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post\Meta as PostMeta;
use App\Models\Term\Taxonomy as TermTaxonomy;
use App\Models\Term\Relationships as TermRelationships;
use App\Models\Traits\HasMeta;

use TinyPixel\AcornModels\Model;

/**
 * Post Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @see        TinyPixel\AcornModels\Models\Post
 *
 * @package    WordPress
 * @subpackage AcornModels
 */
class Post extends Model
{
    use HasMeta;

    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    public $timestamps    = false;
    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    protected $post_type  = null;

    /**
     * Alias
     */
    protected $maps = [
        'id'        => 'ID',
        'date'      => 'date',
        'date_gmt'  => 'date_gmt',
        'title'     => 'post_title',
        'status'    => 'post_status',
        'modified'  => 'post_modified',
        'parent'    => 'post_parent',
        'guid'      => 'guid',
        'type'      => 'post',
        'mime_type' => 'post_mime_type',
        'content'   => 'post_content',
        'excerpt'   => 'post_excerpt',
        'comments'  => 'comment_count',
    ];

    /**
     * Author
     *
     * @return User (collection)
     */
    public function author()
    {
        return $this->hasOne(User::class, 'ID', 'post_author');
    }

    /**
     * Meta
     *
     * @return Meta (collection)
     */
    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    /**
     * Terms
     *
     * @return Taxonomy (collection)
     */
    public function terms()
    {
        return $this->hasManyThrough(
            TermTaxonomy::class,
            TermRelationships::class,
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

    public function scopeStatus($query)
    {
        return $query->where('post_status', $query);
    }

    public function scopePublished()
    {
        return $query->where('post_status', 'publish');
    }

    public function scopeDraft()
    {
        return $query->where('post_status', 'draft');
    }
}
