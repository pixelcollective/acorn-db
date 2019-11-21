<?php
namespace AcornDB\Model;

use AcornDB\Model\Model;
use AcornDB\Model\Post;
use AcornDB\Model\Comment;
use AcornDB\Concerns\AdvancedCustomFields;
use AcornDB\Concerns\Aliases;
use AcornDB\Concerns\MetaFields;
use AcornDB\Concerns\OrderScopes;

/**
 * WordPress User
 *
 * @author Ashwin Sureshkumar <ashwin.sureshkumar@gmail.com>
 * @author Mickael Burguet <www.rundef.com>
 * @author Junior Grossi <juniorgro@gmail.com>
 * @author Kelly Mears  <developers@tinypixel.dev>
 */
class User extends Model
{
    use AdvancedCustomFields;
    use Aliases;
    use MetaFields;
    use OrderScopes;

    const CREATED_AT = 'user_registered';
    const UPDATED_AT = null;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * @var array
     */
    protected $hidden = ['user_pass'];

    /**
     * @var array
     */
    protected $dates = ['user_registered'];

    /**
     * @var array
     */
    protected $with = ['meta'];

    /**
     * @var array
     */
    protected static $aliases = [
        'login' => 'user_login',
        'email' => 'user_email',
        'slug' => 'user_nicename',
        'url' => 'user_url',
        'nickname' => ['meta' => 'nickname'],
        'first_name' => ['meta' => 'first_name'],
        'last_name' => ['meta' => 'last_name'],
        'description' => ['meta' => 'description'],
        'created_at' => 'user_registered',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'login',
        'email',
        'slug',
        'url',
        'nickname',
        'first_name',
        'last_name',
        'avatar',
        'created_at',
    ];

    /**
     * @param mixed $value
     */
    public function setUpdatedAtAttribute($value)
    {
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'post_author');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * Get the avatar url from Gravatar
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        $hash = !empty($this->email) ? md5(strtolower(trim($this->email))) : '';

        return sprintf('//secure.gravatar.com/avatar/%s?d=mm', $hash);
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setUpdatedAt($value)
    {
        //
    }
}
