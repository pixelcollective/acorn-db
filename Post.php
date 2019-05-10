<?php

namespace App\Models;

use \App\Helpers\Traits\HasMeta;
use \App\Models\User;
use \App\Models\Post\Meta as PostMeta;
use \App\Models\Term\Taxonomy as TermTaxonomy;
use \App\Models\Term\Relationships as TermRelationships;
use \App\Models\Attachment as Attachment;
use \App\Models\Comment as Comment;

use \Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasMeta;

    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    protected $post_type  = null;
    public $timestamps    = false;

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
        return $this->with('term')
                    ->hasManyThrough(
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

    public function attachments()
    {
        return
            $this
            ->hasMany(Attachment::class, 'post_parent', 'ID')
            ->where('post_type', 'attachment');
    }

    public function tags()
    {
        return $this->terms()->where('taxonomy', 'post_tag');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_post_ID');
    }

    public function scopeStatus($query, $status = 'publish')
    {
        return $query->where('post_status', $status);
    }

    public function scopeType($query, $type = 'post')
    {
        return $query->where('post_type', $type);
    }

    public function scopePublished($query)
    {
        return $query->where('post_status', 'publish');
    }
}
