<?php

namespace App\Models\Post;

use App\Models\Post;

use \Illuminate\Database\Eloquent\Model;

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
