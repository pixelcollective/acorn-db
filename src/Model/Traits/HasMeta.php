<?php

namespace TinyPixel\Acorn\Database\Model\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\Acorn\Support\Utility;
use TinyPixel\Acorn\Database\Exceptions\EloquentException;

trait HasMeta
{
    /**
     * Alias for meta.
     *
     * @return HasMany
     */
    public function fields() : HasMany
    {
        return $this->meta();
    }

    /**
     * A meta item has many keyed values.
     *
     * @return HasMany
     */
    public function meta() : HasMany
    {
        return $this->hasMany($this->getMetaClass(), $this->getMetaForeignKey());
    }

    /**
     * @return string
     * @throws \UnexpectedValueException
     */
    protected function getMetaClass()
    {
        foreach ($this->builtInClasses as $model => $meta) {
            if ($this instanceof $model) {
                return $meta;
            }
        }

        throw new EloquentException('Not a supported meta type');
    }

    /**
     * @return string
     * @throws \UnexpectedValueException
     */
    protected function getMetaForeignKey(): string
    {
        foreach ($this->builtInClasses as $model => $meta) {
            if ($this instanceof $model) {
                return sprintf('%s_id', strtolower(class_basename($model)));
            }
        }

        throw new UnexpectedValueException(sprintf(
            '%s must extends one of Corcel built-in models: Comment, Post, Term or User.',
            static::class
        ));
    }

    /**
     * Get meta value for a given key.
     *
     * @uses   TinyPixel\Support\Utility
     * @param  string $metaKey
     * @return string
     */
    public function getMeta(string $metaKey) : string
    {
        $metaValue = $this->meta()
            ->where('meta_key', $metaKey)
            ->pluck('meta_value')->first();

        if (Utility::isSerialized($metaValue)) {
            $metaValue = unserialize($metaValue);
        }

        return isset($metaValue) ? $metaValue : '';
    }

    /**
     * Set a meta value.
     *
     * @param  string $key
     * @param  string $value
     * @return self
     */
    public function addMeta($key, $value) : self
    {
        $value = is_array($value) ? serialize($value) : $value;

        $meta = $this->meta()->firstOrCreate(['meta_key' => $key]);

        $meta = $this->meta()->where(['meta_key' => $key])
            ->update(['meta_value' => $value]);

        return $this;
    }

    /**
     * Delete meta from model.
     *
     * @param  string $metaKey
     * @return void
     */
    public function removeMeta(string $metaKey) : void
    {
        $this->meta()->where('meta_key', $metaKey)->delete();
    }
}
