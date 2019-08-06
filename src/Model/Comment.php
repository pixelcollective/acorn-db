<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\User;
use TinyPixel\Acorn\Database\Model\Comment\CommentMeta;
use TinyPixel\Acorn\Database\Model\Traits\MetaFields;

/**
 * Comment Model
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 * @uses    Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Comment
 **/
class Comment extends WordPress
{
    use MetaFields;

    /** @var string */
    const CREATED_AT = 'comment_date';

    /** @var null */
    const UPDATED_AT = null;

    /** @var string */
    protected $table = 'comments';

    /** @var string */
    protected $primaryKey = 'comment_ID';

    /** @var array */
    protected $fillable = [];

    /** @var array */
    protected $dates = ['comment_date'];

    /**
     * A comment belongs to a post.
     *
     * @return BelongsTo
     **/
    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class, 'comment_post_ID');
    }

    /**
     * Alias
     *
     * @return BelongsTo
     **/
    public function parent() : BelongsTo
    {
        return $this->original();
    }

    /**
     * A comment can be parented by another comment.
     *
     * @return BelongsTo
     **/
    public function original() : BelongsTo
    {
        return $this->belongsTo(Comment::class, 'comment_parent');
    }

    /**
     * A comment can have many replies.
     *
     * @return HasMany
     **/
    public function replies() : HasMany
    {
        return $this->hasMany(Comment::class, 'comment_parent');
    }

    /**
     * Comment is approved.
     *
     * @return bool
     **/
    public function isApproved() : bool
    {
        return $this->attributes['comment_approved'] == 1;
    }

    /**
     * Comment is a reply
     *
     * @return bool
     **/
    public function isReply() : bool
    {
        return $this->attributes['comment_parent'] > 0;
    }

    /**
     * Comment has replies.
     *
     * @return bool
     **/
    public function hasReplies() : bool
    {
        return $this->replies->count() > 0;
    }

    /**
     * Get a comment using the post's id.
     *
     * @param  int $postId
     * @return Comment
     **/
    public static function findByPostId(int $postId)
    {
        return (new static())
            ->where('comment_post_ID', $postId)
            ->get();
    }

    /**
     * @param  Builder $query
     * @return CommentBuilder
     **/
    public function newEloquentBuilder($query)
    {
        return new CommentBuilder($query);
    }

    /**
     * @param mixed $value
     * @return void
     **/
    public function setUpdatedAt($value)
    {
        // --
    }
}
