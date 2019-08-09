<?php

namespace TinyPixel\AcornDB\Model;

use \Exception;
use TinyPixel\AcornDB\Utility;
use TinyPixel\AcornDB\Model\WordPress;

/**
 * Option Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Option extends WordPress
{
    /**
     * Specify table name.
     *
     * @var string
     */
    protected $table = 'options';

    /**
     * Specify table primary key.
     *
     * @var string
     */
    protected $primaryKey = 'option_id';

    /**
     * Disable default Eloquent timestamps.
     *
     * @var string
     */
    public $timestamps = false;

    /**
     * Specify virtual model attributes
     * accessed with an accessor.
     *
     * @var array
     */
    protected $appends = ['value'];

    /**
     * Specify column names which can be mass assigned.
     *
     * @var array
     */
    protected $fillable = [
        'option_name',
        'option_value',
        'autoload',
    ];

    /**
     * Alias column names.
     *
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     *
     * @var array
     */
    protected $maps = [
        'id'    => 'option_id',
        'name'  => 'option_name',
        'value' => 'option_value',
    ];

    /**
     * Add option to serialized option.
     *
     * @param  string $key
     * @param  mixed  $value
     * @return Option
     */
    public static function add($key, $value)
    {
        return static::create([
            'option_name' => $key,
            'option_value' => is_array($value) ? serialize($value) : $value,
        ]);
    }

    /**
     * Get option by name.
     *
     * @param  string $name
     * @return mixed
     */
    public static function get($name)
    {
        if ($option = self::where('option_name', $name)->first()) {
            return $option->value;
        }

        return null;
    }

    /**
     * Accessor for all autoloaded options.
     *
     * @return Option
     */
    public static function getAutoloaded()
    {
        return self::where('autoload', 'yes')
                   ->get()
                   ->pluck('value', 'option_name');
    }

    /**
     * Accessor for arrayed options.
     *
     * @param  string $name
     * @return array
     */
    public static function getAll() : array
    {
        return static::asArray();
    }

    /**
     * Accessor for `value` attribute
     *
     * @param  string $key
     * @return mixed
     */
    public static function getValue(string $key = '')
    {
        $value = '';

        if ($key) {
            $value = self::where('name', '=', $key)->value('value');
        }

        if (Utility::isSerialized($value)) {
            $value = unserialize($value);
        }

        return $value;
    }

    /**
     * Return options names and values as an array.
     *
     * @param  array $keys
     * @return array
     */
    public static function asArray($keys = []) : array
    {
        $query = static::query();

        if (!empty($keys)) {
            $query->whereIn('name', $keys);
        }

        return $query->get()
                     ->pluck('value', 'name')
                     ->toArray();
    }

    /**
     * Cast results to array.
     *
     * @return array
     */
    public function toArray() : array
    {
        if ($this instanceof Option) {
            return [$this->option_name => $this->value];
        }

        return parent::toArray();
    }
}
