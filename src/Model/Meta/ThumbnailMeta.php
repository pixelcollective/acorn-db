<?php

namespace TinyPixel\Acorn\Database\Model\Meta;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\Acorn\Database\Model\Attachment;
use TinyPixel\Acorn\Database\Model\Meta\PostMeta;
use TinyPixel\Acorn\Database\Exceptions\EloquentException;

/**
 * Thumbnail Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Meta\Thumbnail
 */
class ThumbnailMeta extends PostMeta
{
    /**
     * Thumbnail sizes.
     */
    const SIZE_THUMBNAIL = 'thumbnail';
    const SIZE_MEDIUM    = 'medium';
    const SIZE_LARGE     = 'large';
    const SIZE_FULL      = 'full';

    /**
     * A thumbnail belongs to an attachmnent.
     *
     * @return BelongsTo
     */
    public function attachment()
    {
        return $this->belongsTo(Attachment::class, 'meta_value');
    }

    /**
     * Get thumbnail at a particular size.
     *
     * @param string $size
     * @return array
     * @throws \Exception
     */
    public function size($size)
    {
        if ($size == self::SIZE_FULL) {
            return $this->attachment->url;
        }

        $meta = unserialize($this->attachment->meta->_wp_attachment_metadata);

        $sizes = Arr::get($meta, 'sizes');

        if (!isset($sizes[$size])) {
            return $this->attachment->url;
        }

        $data = Arr::get($sizes, $size);

        return array_merge($data, [
            'url' => dirname($this->attachment->url).'/'.$data['file'],
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->attachment->guid;
    }
}
