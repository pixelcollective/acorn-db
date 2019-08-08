<?php

namespace TinyPixel\AcornDB\Model\Meta;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\Model\Meta\Meta;

/**
 * Post Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Post\Meta
 **/
class PostMeta extends Meta
{
    /** @var string */
    protected $table = 'postmeta';

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $primaryKey = 'meta_id';

    /** @var array */
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     ***/
    protected $maps = [
        'id'    => 'post_id',
        'key'   => 'meta_key',
        'value' => 'meta_value',
    ];

    /**
     * Post meta belongs to a post.
     *
     * @return BelongsTo
     **/
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
