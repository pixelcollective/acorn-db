<?php

namespace TinyPixel\Acorn\Database\Model\Meta;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Meta\Meta;

/**
 * User Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Meta\User
 **/
class UserMeta extends Meta
{
    /** @var string */
    protected $table = 'usermeta';

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $primaryKey = 'umeta_id';

    /** @var array */
    protected $fillable = [
        'meta_key',
        'meta_value',
    ];

    /**
     * User meta belongs to a single user.
     *
     * @return BelongsTo
     **/
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
