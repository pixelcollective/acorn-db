<?php

namespace TinyPixel\Acorn\Database\Model;

use TinyPixel\Acorn\Database\Model\TermMeta as TermMeta;
use TinyPixel\Acorn\Database\Model\Traits\HasMeta;
use TinyPixel\Acorn\Database\Model\WordPress;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Term Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Term extends WordPress
{
    use HasMeta;

    /** @var string */
    protected $table      = 'terms';

    /** @var string  */
    protected $primaryKey = 'term_id';

    /** @var bool */
    public $timestamps = false;

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     */
    protected $maps = [
        'id'    => 'term_id',
        'key'   => 'meta_key',
        'value' => 'meta_value',
    ];

    /**
     * A term has many meta relations.
     *
     * @return HasMany
     */
    public function meta() : HasMany
    {
        return $this->hasMany(TermMeta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }
}
