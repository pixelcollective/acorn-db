---
name: Option
route: /models/option
menu: Models
---


TinyPixel\Acorn\Database\Models\Option
===============

 Option Model 

* Class name: Option
* Namespace: TinyPixel\Acorn\Database\Models
* Parent class: TinyPixel\Acorn\Database\Models\BaseModel





Properties
----------


### $table

    protected string $table = 'options'





* Visibility: **protected**


### $primaryKey

    protected string $primaryKey = 'option_id'





* Visibility: **protected**


### $timestamps

    public boolean $timestamps = false





* Visibility: **public**


### $fillable

    protected array $fillable = array('option_name', 'option_value', 'autoload')





* Visibility: **protected**


### $maps

    protected array $maps = array('id' => 'option_id', 'name' => 'option_name', 'value' => 'option_value')





* Visibility: **protected**


Methods
-------


### add

    \TinyPixel\Acorn\Database\Models\Option TinyPixel\Acorn\Database\Models\Option::add(string $key, mixed $value)

Add option to model



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **string**
* $value **mixed**



### get

    mixed TinyPixel\Acorn\Database\Models\Option::get(string $name)

Get option by name



* Visibility: **public**
* This method is **static**.


#### Arguments
* $name **string**



### getValue

    mixed TinyPixel\Acorn\Database\Models\Option::getValue($key)

Get value, even if serialized.



* Visibility: **public**
* This method is **static**.


#### Arguments
* $key **mixed**



### asArray

    array TinyPixel\Acorn\Database\Models\Option::asArray(array $keys)

Return array of values



* Visibility: **public**
* This method is **static**.


#### Arguments
* $keys **array**



### toArray

    array TinyPixel\Acorn\Database\Models\Option::toArray()

Cast results as array



* Visibility: **public**



