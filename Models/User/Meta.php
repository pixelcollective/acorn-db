<?php

namespace App\Models\User;

use App\Models\User;

use TinyPixel\AcornModels\Model;

class Meta extends Model
{
    protected $table      = 'usermeta';
    public $timestamps    = false;
    protected $primaryKey = 'umeta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
