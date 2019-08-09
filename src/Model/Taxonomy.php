<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TinyPixel\AcornDB\Model\Term;
use TinyPixel\AcornDB\Model\WordPress;
use TinyPixel\AcornDB\Model\Meta\TermMeta;
use TinyPixel\AcornDB\Model\Builder\TaxonomyBuilder;

/**
 * Taxonomy Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Taxonomy extends WordPress
{
    /**
     * Specify table name.
     *
     * @var string
     */
    protected $table = 'term_taxonomy';

    /**
     * Specify primary key.
     *
     * @var string
     */
    protected $primaryKey = 'term_taxonomy_id';

    /**
     * Specify relationships to be eager-loaded.
     *
     * @var string
     */
    protected $with = ['term'];

    /**
     * Disable Laravel default timestamp behavior.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * A taxonomy is related to many term meta fields.
     *
     * @return HasMany
     */
    public function meta()
    {
        return $this->hasMany(TermMeta::class, 'term_id');
    }

    /**
     * A taxonomy belongs to a term.
     *
     * @return BelongsTo
     */
    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id');
    }

    /**
     * A taxonomy can be parented by many taxonomies.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Taxonomy::class, 'parent');
    }

    /**
     * A taxonomy belongs to many posts.
     *
     * @return BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(
            Post::class,
            'term_relationships',
            'term_taxonomy_id',
            'object_id'
        );
    }

    /**
     * Create a new Builder instance.
     *
     * @param  Builder $query
     * @return TaxonomyBuilder
     */
    public function newEloquentBuilder($query) : TaxonomyBuilder
    {
        return new TaxonomyBuilder($query);
    }

    /**
     * Refresh builder.
     *
     * @return TaxonomyBuilder
     */
    public function newQuery() : TaxonomyBuilder
    {
        return isset($this->taxonomy) && $this->taxonomy ?
            parent::newQuery()->where('taxonomy', $this->taxonomy) :
            parent::newQuery();
    }

    /**
     * Return post meta data more naturally.
     *
     * @param  string $key
     * @return string
     */
    public function __get($key) : string
    {
        if (!isset($this->$key)) {
            if (isset($this->term->$key)) {
                return $this->term->$key;
            }
        }

        return parent::__get($key);
    }
}
