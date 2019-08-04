---
name: Post
route: /models/post
menu: Models
---


TinyPixel\Acorn\Database\Models\Post
===============

 Post Model 

* Class name: Post
* Namespace: TinyPixel\Acorn\Database\Models
* Parent class: TinyPixel\Acorn\Database\Models\BaseModel



Constants
----------


### CREATED_AT

    const CREATED_AT = 'post_date'





### UPDATED_AT

    const UPDATED_AT = 'post_modified'





Properties
----------


### $timestamps

    public mixed $timestamps = false





* Visibility: **public**


### $table

    protected mixed $table = 'posts'





* Visibility: **protected**


### $primaryKey

    protected mixed $primaryKey = 'ID'





* Visibility: **protected**


### $post_type

    protected mixed $post_type = null





* Visibility: **protected**


### $maps

    protected mixed $maps = array('id' => 'ID', 'date' => 'post_date', 'date_gmt' => 'post_date_gmt', 'title' => 'post_title', 'status' => 'post_status', 'modified' => 'post_modified', 'parent' => 'post_parent', 'type' => 'post_type', 'mime_type' => 'post_mime_type', 'content' => 'post_content', 'excerpt' => 'post_excerpt', 'comments' => 'comment_count', 'password' => 'post_password')





* Visibility: **protected**


Methods
-------


### author

    \TinyPixel\Acorn\Database\Models\Post TinyPixel\Acorn\Database\Models\Post::author()

Author



* Visibility: **public**




### meta

    mixed TinyPixel\Acorn\Database\Models\Post::meta()





* Visibility: **public**




### terms

    mixed TinyPixel\Acorn\Database\Models\Post::terms()





* Visibility: **public**




### categories

    mixed TinyPixel\Acorn\Database\Models\Post::categories()





* Visibility: **public**




### tags

    mixed TinyPixel\Acorn\Database\Models\Post::tags()





* Visibility: **public**




### attachments

    mixed TinyPixel\Acorn\Database\Models\Post::attachments()





* Visibility: **public**




### comments

    mixed TinyPixel\Acorn\Database\Models\Post::comments()





* Visibility: **public**




### scopeType

    mixed TinyPixel\Acorn\Database\Models\Post::scopeType($query, $type)





* Visibility: **public**


#### Arguments
* $query **mixed**
* $type **mixed**



### scopeStatus

    mixed TinyPixel\Acorn\Database\Models\Post::scopeStatus($query, $status)





* Visibility: **public**


#### Arguments
* $query **mixed**
* $status **mixed**



### scopePublished

    mixed TinyPixel\Acorn\Database\Models\Post::scopePublished($query)





* Visibility: **public**


#### Arguments
* $query **mixed**



### scopeDraft

    mixed TinyPixel\Acorn\Database\Models\Post::scopeDraft($query)





* Visibility: **public**


#### Arguments
* $query **mixed**



### getMeta

    mixed TinyPixel\Acorn\Database\Models\Post::getMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**



### setMeta

    mixed TinyPixel\Acorn\Database\Models\Post::setMeta($key, $value)





* Visibility: **public**


#### Arguments
* $key **mixed**
* $value **mixed**



### deleteMeta

    mixed TinyPixel\Acorn\Database\Models\Post::deleteMeta($meta_key)





* Visibility: **public**


#### Arguments
* $meta_key **mixed**


