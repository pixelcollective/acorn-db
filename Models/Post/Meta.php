<?php

namespace App\Models\Post;

use App\Models\Post;

use TinyPixel\AcornModels\Model;

class Meta extends Model
{
    protected $table      = 'postmeta';
    public $timestamps    = false;
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
