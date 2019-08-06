<?php

namespace TinyPixel\Acorn\Database\Model\Builder;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Post Builder
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Builder\Taxonomy
 ***/
class PostBuilder extends Builder
{
    /**
     * Query post status
     *
     * @param  string $status
     * @return PostBuilder
     **/
    public function status($status) : PostBuilder
    {
        return $this->where('post_status', $status);
    }

    /**
     * Returns posts with status of 'publish'
     *
     * @return PostBuilder
     **/
    public function published() : PostBuilder
    {
        return $this->where(function ($query) {
            $query->status('publish')->orWhere(function ($query) {
                $date = Carbon::now()->format('Y-m-d H:i:s');

                $query->status('future')->where('post_date', '<=', $date);
            });
        });
    }

    /**
     * Query posts matching a single post type.
     *
     * @param  string $type
     * @return PostBuilder
     **/
    public function type($type) : PostBuilder
    {
        return $this->where('post_type', $type);
    }

    /**
     * Query posts which are in the array.
     *
     * @param  array $types
     * @return PostBuilder
     **/
    public function typeIn(array $types) : PostBuilder
    {
        return $this->whereIn('post_type', $types);
    }

    /**
     * Query post with a matching slug.
     *
     * @param  string $slug
     * @return PostBuilder
     **/
    public function slug(string $slug) : PostBuilder
    {
        return $this->where('post_name', $slug);
    }

    /**
     * Query posts which have a specific parent.
     *
     * @param  string $postParentId
     * @return PostBuilder
     **/
    public function parent(string $postParentId) : PostBuilder
    {
        return $this->where('post_parent', $postParentId);
    }

    /**
     * Query posts using a specified term and taxonomy.
     *
     * @param  string $taxonomy
     * @param  mixed $terms
     * @return PostBuilder
     **/
    public function taxonomy(string $taxonomy, $terms) : PostBuilder
    {
        return $this->whereHas('taxonomies', function ($query) use ($taxonomy, $terms) {
            $query = $query->where('taxonomy', $taxonomy);

            $query->whereHas('term', function ($query) use ($terms) {
                $query->whereIn('slug', is_array($terms) ? $terms : [$terms]);
            });
        });
    }

    /**
     * Query posts using a search phrase or phrases
     * correlated against titles, excerpts, content and taxonomic terms.
     *
     * @param  mixed $term
     * @return PostBuilder
     **/
    public function search($term = false) : PostBuilder
    {
        /**
         * If no terms were specified then
         * bounce early by returning the builder instance.
         */
        if (empty($term)) {
            return $this;
        }

        /**
         * Explode stringy search terms on non-breaking spaces
         */
        $terms = is_string($term) ? explode(' ', $term) : $term;

        /**
         * Collect search terms and remove '%' characters.
         * Then map the result to construct database query strings.
         */
        $terms = collect($terms)->map(function ($term) {
            return trim(str_replace('%', '', $term));
        })->filter()->map(function ($term) {
            return '%' . $term . '%';
        });

        /**
         * If there is nothing left after manipulating the collection
         * then exit early by returning the Builder.
         */
        if ($terms->isEmpty()) {
            return $this;
        }

        /**
         * Return search results
         */
        return $this->where(function ($query) use ($terms) {
            $terms->each(function ($term) use ($query) {
                $query->orWhere('post_title', 'like', $term)
                      ->orWhere('post_excerpt', 'like', $term)
                      ->orWhere('post_content', 'like', $term);
            });
        });
    }
}
