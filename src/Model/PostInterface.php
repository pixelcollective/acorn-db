<?php
namespace TinyPixel\AcornDB\Model;

interface PostInterface
{
    public function newFromBuilder(array $attributes, $connection);

    public function newEloquentBuilder($query);

    public function newQuery();

    public function thumbnail();

    public function taxonomies();

    public function comments();

    public function author();

    public function parent();

    public function children();

    public function attachment();

    public function revision();

    public function hasTerm(string $taxonomy, string $term);

    public function getPostType();

    public function getContentAttribute();

    public function getExcerptAttribute();

    public function getImageAttribute();

    public function getTermsAttribute();

    public function getMainCategoryAttribute();

    public function getKeywordsAttribute();

    public function getKeywordsStrAttribute();

    public function getFormat();

    public function __get(string $key);
}
