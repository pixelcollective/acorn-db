<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Attachment;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Taxonomy;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Model\Relationship\TermRelationship;
use TinyPixel\Acorn\Database\Model\Concerns\MetaFields;
use TinyPixel\Acorn\Database\Model\Concerns\Fields;
use TinyPixel\Acorn\Database\Model\Builder\PostBuilder;

/**
 * Post Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Post
 **/
class Post extends WordPress
{
    use Fields, MetaFields;

    /** @var string */
    const CREATED_AT = 'post_date';

    /** @var string */
    const UPDATED_AT = 'post_modified';

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'posts';

    /** @var string */
    protected $primaryKey = 'ID';

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     **/
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
     * A post has a thumbnail.
     *
     * @return HasOne
     **/
    public function thumbnail() : HasOne
    {
        return $this->hasOne(ThumbnailMeta::class, 'post_id')
                    ->where('meta_key', '_thumbnail_id');
    }

    /**
     * A post belongs to many taxonomies.
     *
     * @return BelongsToMany
     **/
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
     **/
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'comment_post_ID');
    }

    /**
     * A post belongs to an author.
     *
     * @return BelongsTo
     **/
    public function author() : BelongsTo
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    /**
     * A post can be parented by another post.
     *
     * @return BelongsTo
     **/
    public function parent() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_parent');
    }

    /**
     * A post can have many children.
     *
     * @return HasMany
     **/
    public function children() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent');
    }

    /**
     * A post can have many attachments.
     *
     * @return HasMany
     **/
    public function attachment() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent')
                    ->where('post_type', 'attachment');
    }

    /**
     * A post can have many revisions.
     *
     * @return HasMany
     **/
    public function revision() : HasMany
    {
        return $this->hasMany(Post::class, 'post_parent')
                    ->where('post_type', 'revision');
    }

    /**
     * Whether the post contains the term or not.
     *
     * @param string $taxonomy
     * @param string $term
     * @return bool
     **/
    public function hasTerm($taxonomy, $term) : bool
    {
        return isset($this->terms[$taxonomy]) &&
            isset($this->terms[$taxonomy][$term]);
    }

    /**
     * Returns the post type.
     *
     * @return string
     **/
    public function getPostType() : string
    {
        return $this->postType;
    }

    /**
     * Returns the post thumbnail.
     *
     * @return string
     **/
    public function getImageAttribute() : string
    {
        if ($this->thumbnail and $this->thumbnail->attachment) {
            return $this->thumbnail->attachment->guid;
        }
    }

    /**
     * Returns terms grouped by taxonomy in an associative array.
     *
     * @return array
     **/
    public function getTermsAttribute() : array
    {
        return $this->taxonomies->groupBy(function ($taxonomy) {
            return $taxonomy->taxonomy == 'post_tag' ? 'tag' : $taxonomy->taxonomy;
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
     **/
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
     **/
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
     **/
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
     **/
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

    /**
     * Getter method.
     *
     * @param  string $key
     * @return mixed
     **/
    public function __get($key)
    {
        $value = parent::__get($key);

        if ($value === null && !property_exists($this, $key)) {
            return $this->meta->$key;
        }

        return $value;
    }

    /**
     * Return a new PostBuilder instance
     *
     * @param  Builder $query
     * @return PostBuilder
     **/
    public function newEloquentBuilder($query) : PostBuilder
    {
        return new PostBuilder($query);
    }

    /**
     * Return a fresh PostBuilder query
     *
     * @return PostBuilder
     **/
    public function newQuery()
    {
        return $this->postType
                    ? parent::newQuery()->type($this->postType)
                    : parent::newQuery();
    }
}
