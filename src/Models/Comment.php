<?php

namespace TinyPixel\Acorn\Database\Models;

use TinyPixel\Acorn\Database\Models\Post;
use TinyPixel\Acorn\Database\Models\User;
use TinyPixel\Acorn\Database\Models\Comment\Meta as CommentMeta;
use TinyPixel\Acorn\Database\Models\Traits\HasMeta;

use TinyPixel\Acorn\Database\Models\BaseModel;

class Comment extends BaseModel
{
    use HasMeta;

    protected $table      = 'comments';
    protected $primaryKey = 'comment_ID';
    protected $fillable   = [];
    public $timestamps    = false;

    const CREATED_AT = 'comment_date';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function meta()
    {
        return $this->hasMany(CommentMeta::class, 'comment_id')
                    ->select(['comment_id', 'meta_key', 'meta_value']);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'ID', 'user_id');
    }
}
