<?php

namespace App\Models;

use \App\Models\Traits\HasMeta;
use \App\Models\Traits\HasRoles;

use \App\Models\Models\Post;
use \App\Models\Models\Comment;
use \App\Models\Models\User\Meta as UserMeta;

use \Illuminate\Database\Eloquent\Model;

/**
 * User Model
 */
class User extends Model
{
    use HasMeta, HasRoles;

    protected $table      = 'users';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    const CREATED_AT = 'user_registered';

    /**
     * Posts: Has Many
     *
     * @return object User Posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_author')
                    ->where('post_status', 'publish')
                    ->where('post_type', 'post');
    }

    /**
     * Comments: Has Many
     *
     * @return object User comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Meta: Has Many
     *
     * @return object User meta
     */
    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id')
                    ->select(['user_id', 'meta_key', 'meta_value']);
    }

}
