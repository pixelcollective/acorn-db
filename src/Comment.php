<?php

namespace TinyPixel\Models;

use \TinyPixel\Models\{
    Post,
    User,
    Comment\Meta as CommentMeta,
    Traits\HasMeta
};

use \Illuminate\Database\Eloquent\Model;

class Comment extends Model
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
