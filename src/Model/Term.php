<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Model\TermMeta;
use TinyPixel\Acorn\Database\Model\Traits\Fields;
use TinyPixel\Acorn\Database\Model\Traits\MetaFields;

/**
 * Term Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Term
 **/
class Term extends WordPress
{
    use Fields, MetaFields;

    /** @var string */
    protected $table = 'terms';

    /** @var string  **/
    protected $primaryKey = 'term_id';

    /** @var bool */
    public $timestamps = false;

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     **/
    protected $maps = [
        'id'    => 'term_id',
        'key'   => 'meta_key',
        'value' => 'meta_value',
    ];

    /**
     * A term has many meta relations.
     *
     * @return HasMany
     **/
    public function meta() : HasMany
    {
        return $this->hasMany(TermMeta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }
}
