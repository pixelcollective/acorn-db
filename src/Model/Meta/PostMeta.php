<?php
namespace AcornDB\Model\Meta;

use AcornDB\Model\Post;

/**
 * Meta: Post
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class PostMeta extends Meta
{
    /**
     * @var string
     */
    protected $table = 'postmeta';

    /**
     * @var array
     */
    protected $fillable = ['meta_key', 'meta_value', 'post_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
