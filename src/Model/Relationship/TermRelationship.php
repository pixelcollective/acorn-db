<?php

namespace TinyPixel\Acorn\Database\Model\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\Acorn\Database\Model\WordPress;

/**
 * Term Relationship Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model
 */
class TermRelationship extends WordPress
{
    /** @var string */
    protected $table = 'term_relationships';

    /** @var string */
    protected $primaryKey = ['object_id', 'term_taxonomy_id'];

    /** @var bool */
    protected $timestamps = false;

    /** @var bool */
    public $incrementing = false;

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     */
    public $maps = [
        'postId'     => 'object_id',
        'taxonomyId' => 'term_taxonomy_id',
    ];

    /**
     * A term relates to a post based on its `object_id`.
     *
     * @return BelongsTo
     */
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'object_id');
    }

    /**
     * A term relates to a taxonomy based on its `term_taxonomy_id`.
     *
     * @return BelongsTo
     */
    public function taxonomy() : BelongsTo
    {
        return $this->belongsTo(Taxonomy::class, 'term_taxonomy_id');
    }
}
