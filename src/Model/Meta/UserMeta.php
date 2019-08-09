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
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class UserMeta extends Meta
{
    /**
     * Specify table name.
     *
     * @var string
     */
    protected $table = 'usermeta';

    /**
     * Specify a table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'umeta_id';

    /**
     * Specify timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Specify a table primary key.
     *
     * @var string
     */
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
