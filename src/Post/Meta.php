<?php

namespace TinyPixel\Models\Post;

use \TinyPixel\Models\Post;
use \Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table   = 'postmeta';
    public $timestamps = false;
    protected $fillable = ['meta_key', 'meta_value'];
    protected $primaryKey = 'meta_id';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
