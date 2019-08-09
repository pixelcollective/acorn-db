<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\AcornDB\Model\WordPress;
use TinyPixel\AcornDB\Model\TermMeta;
use TinyPixel\AcornDB\Model\Concerns\Fields;
use TinyPixel\AcornDB\Model\Concerns\MetaFields;

/**
 * Term Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Term extends WordPress
{
    use Fields, MetaFields;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'terms';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'term_id';

    /**
     * Alias column names.
     *
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     *
     * @var array
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
