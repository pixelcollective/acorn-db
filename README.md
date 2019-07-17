# Acorn Models

Provides Acorn projects with an Eloquent model for use in WordPress.

## Requirements

[Sage](https://github.com/roots/sage) >= 10.0

[PHP](https://secure.php.net/manual/en/install.php) >= 7.3

[Composer](https://getcomposer.org)

## Installation

Install via composer:

```bash
composer require tiny-pixel/acorn-models
```

If your database is not already configured you can also jumpstart that after installation with

```bash
wp acorn vendor:publish
```

Now anytime you would normally use `get_posts` or `WP_Query` you can instead run eloquent queries on the models:

```php

use TinyPixel\Models\Post;

/**
 * Returns all published posts
 *
 * @return \Illuminate\Support\Collection
 */
function published()
{
    return Post::ofType('post')
                ->ofStatus('publish')
                ->with('meta')
                ->with('author');
}

 /**
  * Returns random published posts
  *
  * @param int $excludePostId
  * @return \Illuminate\Support\Collection
  */
function randomPosts($excludePostId = get_the_ID())
{
    return Post::published()
                ->orderByRaw('RAND()')
                ->where('id', '!=', $excludePostId)
                ->take(3)
                ->get();
}

// ...etc
```
