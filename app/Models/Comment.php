<?php

namespace App\Models;

use \App\Models\Traits\HasMeta;
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
        return $this->belongsTo(\App\Models\Post::class);
    }

    public function meta()
    {
        return $this->hasMany(\App\Models\Comment\Meta::class, 'comment_id')
                    ->select(['comment_id', 'meta_key', 'meta_value']);
    }

    public function user()
    {
        return $this->hasOne(\App\Models\User::class, 'ID', 'user_id');
    }
}
