<?php

namespace TinyPixel\AcornDB\Model\Meta;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\Term;
use TinyPixel\AcornDB\Model\Meta\Meta;

/**
 * Term Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Meta\Term
 **/
class TermMeta extends Meta
{
    /** @var string */
    protected $table = 'term_meta';

    /** @var string */
    protected $primaryKey = 'meta_id';

    /** @var array */
    protected $fillable = [
        'meta_key',
        'meta_value',
    ];

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     ***/
    protected $maps = [
        'id'    => 'term_id',
        'key'   => 'meta_key',
        'value' => 'meta_value',
    ];

    /**
     * Term meta belongs to a term.
     *
     * @return BelongsTo
     **/
    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }
}
