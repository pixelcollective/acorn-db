<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TinyPixel\AcornDB\Model\WordPress;
use TinyPixel\AcornDB\Model\User;
use TinyPixel\AcornDB\Model\Attachment;
use TinyPixel\AcornDB\Model\Comment;
use TinyPixel\AcornDB\Model\Taxonomy;
use TinyPixel\AcornDB\Model\Meta\PostMeta;
use TinyPixel\AcornDB\Model\Meta\ThumbnailMeta;
use TinyPixel\AcornDB\Model\Concerns\MetaFields;
use TinyPixel\AcornDB\Model\Concerns\Fields;
use TinyPixel\AcornDB\Model\Concerns\Timestamps;
use TinyPixel\AcornDB\Model\Builder\PostBuilder;
use TinyPixel\AcornDB\Model\Relationship\TermRelationship;

/**
 * Post Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Post extends WordPress
{
    use Fields, MetaFields, Timestamps;

    /**
     * Specify table name.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * Specify primary key.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * Specify `created_at` column.
     *
     * @var string
     */
    const CREATED_AT = 'post_date';

    /**
     * Specify `updated_at` column.
     *
     * @var string
     */
    const UPDATED_AT = 'post_modified';

    /**
     * Specify column name aliases.
     *
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     *
     * @var array
     */
    protected $maps = [
        'id'        => 'ID',
        'date'      => 'post_date',
        'date_gmt'  => 'post_date_gmt',
        'title'     => 'post_title',
        'status'    => 'post_status',
        'modified'  => 'post_modified',
        'parent'    => 'post_parent',
        'type'      => 'post_type',
        'mime_type' => 'post_mime_type',
        'content'   => 'post_content',
        'excerpt'   => 'post_excerpt',
        'comments'  => 'comment_count',
        'password'  => 'post_password',
        'url'       => 'guid',
    ];

    /**
     * Magic getter method.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $value = parent::__get($key);

        if ($value === null && !property_exists($this, $key)) {
            return $this->meta->$key;
        }

        return $value;
    }

    /**
     * Return a fresh PostBuilder query
     *
     * @return PostBuilder
     */
    public function newQuery()
    {
        return $this->postType ?
                parent::newQuery()->type($this->postType) :
                parent::newQuery();
    }

    /**
     * Return a new PostBuilder instance
     *
     * @param  Builder $query
     * @return PostBuilder
     */
    public function newEloquentBuilder($query) : PostBuilder
    {
        return new PostBuilder($query);
    }

    /**
     * A post has a thumbnail.
     *
     * @return HasOne
     */
    public function thumbnail() : HasOne
    {
        return $this->hasOne(ThumbnailMeta::class, 'post_id')
                    ->where('meta_key', '_thumbnail_id');
    }

    /**
     * A post belongs to many taxonomies.
     *
     * @return BelongsToMany
     */
    public function taxonomies() : BelongsToMany
    {
        return $this->belongsToMany(
            Taxonomy::class,
            'term_relationships',
            'object_id',
            'term_taxonomy_id'
        );
    }

    /**
     * A post has many comments.
     *
     * @return HasMany
     */
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'comment_post_ID');
    }

    /**
     * A post belongs to an author.
     *
     * @return BelongsTo
     */
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    /**
     * A post can be parented by another post.
     *
     * @return BelongsTo
     */
    public function parent() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_parent');
    }

    /**
     * A post can have many children.
     *
     * @return HasMany
     */
    public function children() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent');
    }

    /**
     * A post can have many attachments.
     *
     * @return HasMany
     */
    public function attachment() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent')
                    ->where('post_type', 'attachment');
    }

    /**
     * A post can have many revisions.
     *
     * @return HasMany
     */
    public function revision() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent')
                    ->where('post_type', 'revision');
    }

    /**
     * Return true if the post contains a specified term.
     *
     * @param string $taxonomy
     * @param string $term
     * @return bool
     */
    public function hasTerm($taxonomy, $term) : bool
    {
        return isset($this->terms[$taxonomy]) &&
            isset($this->terms[$taxonomy][$term]);
    }

    /**
     * Accessor returning posttype.
     *
     * @return string
     */
    public function getPostType() : string
    {
        return $this->postType;
    }

    /**
     * Accessor returning post thumbnail.
     *
     * @return string
     */
    public function getImageAttribute() : string
    {
        if ($this->thumbnail and $this->thumbnail->attachment) {
            return $this->thumbnail->attachment->guid;
        }
    }

    /**
     * Accessor returning array of terms grouped by taxonomy.
     *
     * @return array
     */
    public function getTermsAttribute() : array
    {
        return $this->taxonomies->groupBy(function ($taxonomy) {
            return $taxonomy->taxonomy == 'post_tag' ?
                'tag' : $taxonomy->taxonomy;
        })->map(function ($group) {
            return $group->mapWithKeys(function ($item) {
                return [$item->term->slug => $item->term->name];
            });
        })->toArray();
    }

    /**
     * Returns the primary term from the first taxonomy found.
     *
     * @return string
     */
    public function getMainCategoryAttribute()
    {
        $mainCategory = 'Uncategorized';

        if (!empty($this->terms)) {
            $taxonomies = array_values($this->terms);

            if (!empty($taxonomies[0])) {
                $terms = array_values($taxonomies[0]);
                $mainCategory = $terms[0];
            }
        }

        return $mainCategory;
    }

    /**
     * Returns an array of the post keywords.
     *
     * @return array
     */
    public function getKeywordsAttribute()
    {
        return collect($this->terms)->map(function ($taxonomy) {
            return collect($taxonomy)->values();
        })->collapse()->toArray();
    }

    /**
     * Returns a comma delimited string of the post keywords.
     *
     * @return string
     */
    public function getKeywordsStrAttribute()
    {
        return implode(',', (array) $this->keywords);
    }

    /**
     * Returns the post format.
     *
     * @see \get_post_format
     * @link https://codex.wordpress.org/Function_Reference/get_post_format
     *
     * @return bool|string
     */
    public function getFormat()
    {
        $taxonomy = $this->taxonomies()
                         ->where('taxonomy', 'post_format')
                         ->first();

        if ($taxonomy && $taxonomy->term) {
            return str_replace('post-format-', '', $taxonomy->term->slug);
        }

        return false;
    }
}
