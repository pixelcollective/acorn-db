<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Comment;
use TinyPixel\Acorn\Database\Model\Meta\UserMeta;
use TinyPixel\Acorn\Database\Model\Concerns\MetaFields;
use TinyPixel\Acorn\Database\Model\Concerns\Roles;

/**
 * User Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\User
 **/
class User extends WordPress
{
    use MetaFields, Roles;

    /** @var string */
    protected $table = 'users';

    /** @var string */
    protected $primaryKey = 'ID';

    /** @var string */
    public $timestamps = false;

    /** @var string */
    const CREATED_AT = 'user_registered';

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     **/
    protected $maps = [
        'login'       => 'user_login',
        'email'       => 'user_email',
        'slug'        => 'user_nicename',
        'url'         => 'user_url',
        'nickname'    => ['meta' => 'nickname'],
        'first_name'  => ['meta' => 'first_name'],
        'last_name'   => ['meta' => 'last_name'],
        'description' => ['meta' => 'description'],
        'created_at'  => 'user_registered',
    ];

    /**
     * A user has many posts
     *
     * @return HasMany
     **/
    public function posts() : HasMany
    {
        return $this->hasMany(Post::class, 'post_author');
    }

    /**
     * A user has many comments
     *
     * @return HasMany
     **/
    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * A user has many usermeta attributes
     *
     * @return object
     **/
    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id')
                    ->select(['user_id', 'meta_key', 'meta_value']);
    }

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     **/
    public function getAuthIdentifierName() : string
    {
        return $this->primaryKey;
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     **/
    public function getAuthIdentifier()
    {
        return $this->attributes[$this->primaryKey];
    }

    /**
     * Get the password for the user.
     *
     * @return string
     **/
    public function getAuthPassword() : string
    {
        return $this->user_pass;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     **/
    public function getRememberToken() : string
    {
        $tokenName = $this->getRememberTokenName();

        return $this->meta->{$tokenName};
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     **/
    public function setRememberToken(string $value) : void
    {
        $tokenName = $this->getRememberTokenName();

        $this->saveMeta($tokenName, $value);
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     **/
    public function getRememberTokenName() : string
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     **/
    public function getEmailForPasswordReset() : string
    {
        return $this->user_email;
    }

    /**
     * Send password reset notification based on token value
     *
     * @param string $token
     **/
    public function sendPasswordResetNotification($token) : string
    {
        // ---
    }

    /**
     * Get the avatar url from Gravatar
     *
     * @return string
     **/
    public function getAvatarAttribute() : string
    {
        $hash = !empty($this->email) ? md5(strtolower(trim($this->email))) : '';

        return sprintf('//secure.gravatar.com/avatar/%s?d=mm', $hash);
    }

    /**
     * @param mixed $value
     * @return void
     **/
    public function setUpdatedAt($value)
    {
        //
    }

    /**
     * Override updated at attribute setter
     *
     * @param mixed $value
     **/
    public function setUpdatedAtAttribute($value)
    {
        // ---
    }
}
