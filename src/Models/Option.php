<?php

namespace TinyPixel\Acorn\Database\Models;

use Exception;
use TinyPixel\Acorn\Database\Utility;
use TinyPixel\Acorn\Database\Models\BaseModel;

/**
 * Option Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    WordPress
 * @subpackage Acorn\Database
 */
class Option extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'options';

    /**
     * @var string
     */
    protected $primaryKey = 'option_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'option_name',
        'option_value',
        'autoload',
    ];

    /**
     * @var array
     * @see Sofa\Eloquence\Eloquence
     * @see Sofa\Eloquence\Mappable
     */
    protected $maps = [
        'id'    => 'option_id',
        'name'  => 'option_name',
        'value' => 'option_value',
    ];

    /**
     * Add option to model
     *
     * @param string $key
     * @param mixed $value
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
     * Get option by name
     *
     * @param string $name
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
     * Get value, even if serialized.
     *
     * @return mixed
     */
    public static function getValue($key = '')
    {
        $value = '';

        if ($key) {
            $value = self::where('option_name', '=', $key)->value('option_value');
        }

        if (Utility::isSerialized($value)) {
            $value = unserialize($value);
        }

        return $value;
    }

    /**
     * Return array of values
     * @see Corcel\Corcel
     *
     * @param array $keys
     * @return array
     */
    public static function asArray($keys = [])
    {
        $query = static::query();

        if (!empty($keys)) {
            $query->whereIn('option_name', $keys);
        }

        return $query->get()
            ->pluck('value', 'option_name')
            ->toArray();
    }

    /**
     * Cast results as array
     * @see Corcel\Corcel
     *
     * @return array
     */
    public function toArray()
    {
        if ($this instanceof Option) {
            return [$this->option_name => $this->value];
        }

        return parent::toArray();
    }
}
