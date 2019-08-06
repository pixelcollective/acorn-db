<?php

namespace TinyPixel\Acorn\Database\Model;

use TinyPixel\Acorn\Database\Model\Traits\HasMeta;
use TinyPixel\Acorn\Database\Model\Traits\HasRoles;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Meta\UserMeta;

use TinyPixel\Acorn\Database\Model\WordPress;

class User extends WordPress
{
    use HasMeta, HasRoles;

    protected $table      = 'users';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    const CREATED_AT = 'user_registered';

    /**
     * A user has many posts
     *
     * @return object
     */
    public function posts()
    {
        $posts = $this->hasMany(Post::class, 'post_author');

        return $posts
            ->where('post_status', 'publish')
            ->where('post_type', 'post');
    }

    /**
     * A user has many comments
     *
     * @return object
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * A user has many usermeta attributes
     *
     * @return object
     */
    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id')
                    ->select(['user_id', 'meta_key', 'meta_value']);
    }
}
