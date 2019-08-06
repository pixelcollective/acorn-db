<?php

namespace TinyPixel\Acorn\Database\Model\Concerns;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\Acorn\Database\Exception\EloquentException;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Term;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Meta\CommentMeta;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Model\Meta\TermMeta;
use TinyPixel\Acorn\Database\Model\Meta\UserMeta;

/**
 * Concerning meta fields.
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Model\Traits
 **/
trait MetaFields
{
    /** @var array */
    protected $builtInClasses = [
        Post::class    => PostMeta::class,
        Term::class    => TermMeta::class,
        User::class    => UserMeta::class,
        Comment::class => CommentMeta::class,
    ];

    /**
     * An individual meta value can have many additional meta values.
     *
     * @return HasMany
     **/
    public function meta() : HasMany
    {
        return $this->hasMany($this->getMetaClass(), $this->getMetaForeignKey());
    }

    /**
     * Getter for meta type.
     *
     * @return string
     * @throws EloquentException
     **/
    protected function getMetaClass()
    {
        foreach ($this->builtInClasses as $model => $meta) {
            if ($this instanceof $model) {
                return $meta;
            }
        }

        throw new EloquentException(sprintf('%s is not an extension of a known model', static::class));
    }

    /**
     * Getter for meta foreign key.
     *
     * @return string
     * @throws EloquentException
     **/
    protected function getMetaForeignKey(): string
    {
        foreach ($this->builtInClasses as $model => $meta) {
            if ($this instanceof $model) {
                return sprintf('%s_id', strtolower(class_basename($model)));
            }
        }

        throw new EloquentException(sprintf('%s is not an extension of a known model', static::class));
    }

    /**
     * Scopes query to model instances which have specified meta keys.
     *
     * @param  Builder $query
     * @param  string  $meta
     * @param  mixed   $value
     * @param  string  $operator
     * @return Builder
     **/
    public function scopeHasMeta(Builder $query, string $meta, $value = null, string $operator = '=') : Builder
    {
        if (!is_array($meta)) {
            $meta = [$meta => $value];
        }

        foreach ($meta as $key => $value) {
            $query->whereHas('meta', function (Builder $query) use ($key, $value, $operator) {
                if (!is_string($key)) {
                    return $query->where('meta_key', $operator, $value);
                }

                $query->where('meta_key', $operator, $key);

                return ! is_null($value)
                       ? $query->where('meta_value', $operator, $value)
                       : $query;
            });
        }

        return $query;
    }

    /**
     * Scopes query to model instances which have meta 'like' a specified value.
     *
     * @param  Builder $query
     * @param  string  $meta
     * @param  mixed   $value
     * @return Builder
     **/
    public function scopeHasMetaLike(Builder $query, $meta, $value = null) : Builder
    {
        return $this->scopeHasMeta($query, $meta, $value, 'like');
    }

    /**
     * Saves meta value.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return bool
     **/
    public function saveMeta($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->saveOneMeta($k, $v);
            }

            $this->load('meta');

            return true;
        }

        return $this->saveOneMeta($key, $value);
    }

    /**
     * Saves a single meta value.
     *
     * @param  string $key
     * @param  mixed $value
     * @return bool
     **/
    private function saveOneMeta($key, $value)
    {
        $result = $this->meta()
                       ->where('meta_key', $key)
                       ->firstOrNew(['meta_key' => $key])
                       ->fill(['meta_value' => $value])
                       ->save();

        $this->load('meta');

        return $result;
    }

    /**
     * Create a new meta field.
     *
     * @param  string $key
     * @param  mixed $value
     * @return Model|Collection
     **/
    public function createMeta(string $key, $value = null)
    {
        if (is_array($key)) {
            return collect($key)->map(function ($value, $key) {
                return $this->createOneMeta($key, $value);
            });
        }

        return $this->createOneMeta($key, $value);
    }

    /**
     * Create a single meta field.
     *
     * @param  string $key
     * @param  mixed $value
     * @return \Illuminate\Database\Eloquent\Model
     **/
    private function createOneMeta($key, $value)
    {
        $meta = $this->meta()->create([
            'meta_key'   => $key,
            'meta_value' => $value,
        ]);

        $this->load('meta');

        return $meta;
    }

    /**
     * Get meta from string attribute.
     *
     * @param string $attribute
     * @return mixed|null
     **/
    public function getMeta(string $attribute)
    {
        if ($meta = $this->meta->{$attribute}) {
            return $meta;
        }

        return null;
    }

    /**
     * Alias for meta method.
     *
     * @return HasMany
     ***/
    public function fields() : HasMany
    {
        return $this->meta();
    }

    /**
     * Alias for saveMeta method.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return bool
     **/
    public function saveField($key, $value)
    {
        return $this->saveMeta($key, $value);
    }

    /**
     * Alias for createMeta method.
     *
     * @param  string $key
     * @param  mixed $value
     * @return Model
     **/
    public function createField(string $key, $value) : Model
    {
        return $this->createMeta($key, $value);
    }
}
