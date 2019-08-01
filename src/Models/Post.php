<?php

namespace TinyPixel\Acorn\Database\Models;

use TinyPixel\Acorn\Database\Models\User;
use TinyPixel\Acorn\Database\Models\Attachment;
use TinyPixel\Acorn\Database\Models\Comment;
use TinyPixel\Acorn\Database\Models\Traits\HasMeta;
use TinyPixel\Acorn\Database\Models\Post\Meta as PostMeta;
use TinyPixel\Acorn\Database\Models\Term\Taxonomy as TermTaxonomy;
use TinyPixel\Acorn\Database\Models\Term\Relationships as TermRelationships;
use TinyPixel\Acorn\Database\Models\BaseModel;

/**
 * Post Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @see        TinyPixel\Acorn\Database\Models\Post
 *
 * @package    WordPress
 * @subpackage Acorn\Models
 */
class Post extends BaseModel
{
    use HasMeta;

    const CREATED_AT      = 'post_date';
    const UPDATED_AT      = 'post_modified';
    public $timestamps    = false;

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    protected $post_type  = null;

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
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'ID', 'post_author');
    }

    public function meta()
    {
        return $this->hasMany(PostMeta::class, 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

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
