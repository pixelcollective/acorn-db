---
name: Comment
route: /models/comment
menu: Models
---


TinyPixel\Acorn\Database\Models\Comment
===============



* Class name: Comment
* Namespace: TinyPixel\Acorn\Database\Models
* Parent class: TinyPixel\Acorn\Database\Models\BaseModel



Constants
----------


### CREATED_AT

    const CREATED_AT = 'comment_date'





Properties
----------


### $table

    protected mixed $table = 'comments'





* Visibility: **protected**


### $primaryKey

    protected mixed $primaryKey = 'comment_ID'





* Visibility: **protected**


### $fillable

    protected mixed $fillable = array()





* Visibility: **protected**


### $timestamps

    public mixed $timestamps = false





* Visibility: **public**


Methods
-------


### post

    mixed TinyPixel\Acorn\Database\Models\Comment::post()





* Visibility: **public**




### meta

    mixed TinyPixel\Acorn\Database\Models\Comment::meta()





* Visibility: **public**




### user

    mixed TinyPixel\Acorn\Database\Models\Comment::user()





* Visibility: **public**




### getMeta

    mixed TinyPixel\Acorn\Database\Models\Comment::getMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**



### setMeta

    mixed TinyPixel\Acorn\Database\Models\Comment::setMeta($key, $value)





* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**



### deleteMeta

    mixed TinyPixel\Acorn\Database\Models\Comment::deleteMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**


