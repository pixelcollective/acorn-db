<?php

namespace TinyPixel\Acorn\Database\Model\Meta;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Meta\Meta;

/**
 * Comment Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Meta\Comment
 */
class CommentMeta extends Meta
{
    /** @var string */
    protected $table = 'commentmeta';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $fillable = ['meta_key', 'meta_value'];

    /** @var string */
    protected $primaryKey = 'meta_id';

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     */
    protected $maps = [
        'id'    => 'comment_id',
        'key'   => 'meta_key',
        'value' => 'meta_value',
    ];

    /**
     * Comment meta belongs to a comment.
     *
     * @return BelongsTo
     */
    public function comment() : BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
