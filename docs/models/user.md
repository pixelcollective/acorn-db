---
name: User
route: /models/user
menu: Models
---


TinyPixel\Acorn\Database\Models\User
===============



* Class name: User
* Namespace: TinyPixel\Acorn\Database\Models
* Parent class: TinyPixel\Acorn\Database\Models\BaseModel



Constants
----------


### CREATED_AT

    const CREATED_AT = 'user_registered'





Properties
----------


### $table

    protected mixed $table = 'users'





* Visibility: **protected**


### $primaryKey

    protected mixed $primaryKey = 'ID'





* Visibility: **protected**


### $timestamps

    public mixed $timestamps = false





* Visibility: **public**


Methods
-------


### posts

    object TinyPixel\Acorn\Database\Models\User::posts()

A user has many posts



* Visibility: **public**




### comments

    object TinyPixel\Acorn\Database\Models\User::comments()

A user has many comments



* Visibility: **public**




### meta

    object TinyPixel\Acorn\Database\Models\User::meta()

A user has many usermeta attributes



* Visibility: **public**




### getMeta

    mixed TinyPixel\Acorn\Database\Models\User::getMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**



### setMeta

    mixed TinyPixel\Acorn\Database\Models\User::setMeta($key, $value)





* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**



### deleteMeta

    mixed TinyPixel\Acorn\Database\Models\User::deleteMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**



### hasRole

    mixed TinyPixel\Acorn\Database\Models\User::hasRole($role)





* Visibility: **public**


#### Arguments
* $role **mixed**



### hasAnyRoles

    mixed TinyPixel\Acorn\Database\Models\User::hasAnyRoles($roles)





* Visibility: **public**


#### Arguments
* $roles **mixed**



### getCapabilitiesAttribute

    mixed TinyPixel\Acorn\Database\Models\User::getCapabilitiesAttribute()





* Visibility: **public**




### getIsAdminAttribute

    mixed TinyPixel\Acorn\Database\Models\User::getIsAdminAttribute()





* Visibility: **public**



