<?php
namespace AcornDB\ACF\Field;

use AcornDB\ACF\FieldInterface;
use AcornDB\Model\Post;

/**
 * Class User.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class User extends BasicField implements FieldInterface
{
    /**
     * @var \TinyPixel\AcornDB\Model\User
     */
    protected $user;

    /**
     * @var \TinyPixel\AcornDB\Model\User
     */
    protected $value;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
        $this->user = new \TinyPixel\AcornDB\Model\User();
        $this->user->setConnection($post->getConnectionName());
    }

    /**
     * @param string $fieldName
     */
    public function process($fieldName)
    {
        $userId = $this->fetchValue($fieldName);
        $this->value = $this->user->find($userId);
    }

    /**
     * @return \TinyPixel\AcornDB\Model\User
     */
    public function get()
    {
        return $this->value;
    }
}
