<?php

namespace TinyPixel\Acorn\Database\Builder;

use Illuminate\Database\Eloquent\Builder;

/**
 * Taxonomy Builder
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Builder\Taxonomy
 * @see        Corcel\Corcel
 */
class TaxonomyBuilder extends Builder
{
    /**
     * Taxonomy is a category.
     *
     * @return TaxonomyBuilder
     */
    public function category() : TaxonomyBuilder
    {
        return $this->where('taxonomy', 'category');
    }

    /**
     * Taxonomy is a nav.
     *
     * @return TaxonomyBuilder
     */
    public function menu() : TaxonomyBuilder
    {
        return $this->where('taxonomy', 'nav_menu');
    }

    /**
     * Taxonomy with a specific name.
     *
     * @param  string $name
     * @return TaxonomyBuilder
     */
    public function name($name) : TaxonomyBuilder
    {
        return $this->where('taxonomy', $name);
    }

    /**
     * Taxonomy with a specific slug.
     *
     * @param  string $slug
     * @return TaxonomyBuilder
     */
    public function slug($slug = null) : TaxonomyBuilder
    {
        if (!is_null($slug) && !empty($slug)) {
            return $this->whereHas('term', function ($query) use ($slug) {
                $query->where('slug', $slug);
            });
        }

        return $this;
    }

    /**
     * Taxonomy with a specific term.
     *
     * @param  null $slug
     * @return TaxonomyBuilder
     */
    public function term($slug = null) : TaxonomyBuilder
    {
        return $this->slug($slug);
    }
}

