<?php

namespace TinyPixel\AcornDB\Model\Relationships;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\WordPress;

/**
 * Term Relationship Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model/Relationship
 */
class TermRelationship extends WordPress
{
    /**
     * Specify a table name.
     *
     * @var string
     */
    protected $table = 'term_relationships';

    /**
     * Specify a table primary key.
     *
     * @var array
     */
    protected $primaryKey = ['object_id', 'term_taxonomy_id'];

    /**
     * Disable default Eloquent timestamps.
     *
     * @var bool
     */
    protected $timestamps = false;

    /**
     * Disable auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Alias column names.
     *
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     *
     * @var array
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
