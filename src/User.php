<?php

namespace TinyPixel\Models;

use \TinyPixel\Models\{
    Traits\HasMeta,
    Traits\HasRoles,
    Post,
    Comment,
    User\Meta as UserMeta,
};

use \Illuminate\Database\Eloquent\Model;

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
        $posts = $this->hasMany(Post::class, 'post_author');

        return $posts
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
