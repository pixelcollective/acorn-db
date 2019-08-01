<?php

namespace TinyPixel\Acorn\Models\Models;

use TinyPixel\Acorn\Models\Models\Traits\HasMeta;
use TinyPixel\Acorn\Models\Models\Traits\HasRoles;
use TinyPixel\Acorn\Models\Models\Post;
use TinyPixel\Acorn\Models\Models\Comment;
use TinyPixel\Acorn\Models\Models\User\Meta as UserMeta;

use TinyPixel\Acorn\Models\Models\BaseModel;

class User extends BaseModel
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
