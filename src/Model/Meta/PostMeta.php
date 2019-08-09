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
    /**
     * Specify table name.
     *
     * @var string
     */
    protected $table = 'postmeta';

    /**
     * Specify table name.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Specify table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'meta_id';

    /**
     * Specify column names open to mass assignment.
     *
     * @var array
     */
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
