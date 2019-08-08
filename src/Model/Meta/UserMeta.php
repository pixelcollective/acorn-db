<?php

namespace TinyPixel\AcornDB\Model\Meta;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\User;
use TinyPixel\AcornDB\Model\Meta\Meta;

/**
 * User Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
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
