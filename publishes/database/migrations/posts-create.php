<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*
|--------------------------------------------------------------------------
| Database Migrations
|--------------------------------------------------------------------------
|
| Migrations are a type of version control for your database. They
| allow a team to modify the database schema and stay up to date on the
| current schema state. Migrations are typically paired with the Schema
| Builder to easily manage your application's schema.
|
| @see https://laravel.com/docs/4.2/migrations#introduction
|
*/

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->bigInteger('ID');
            $table->bigInteger('post_author')->unsigned();
            $table->dateTime('post_date');
            $table->dateTime('post_date_gmt');
            $table->longText('post_content');
            $table->text('post_title');
            $table->text('post_excerpt');
            $table->string('post_status');
            $table->string('comment_status');
            $table->string('ping_status');
            $table->string('post_password');
            $table->string('post_name');
            $table->text('to_ping');
            $table->text('pinged');
            $table->dateTime('post_modified');
            $table->dateTime('post_modified_gmt');
            $table->longText('post_content_filtered');
            $table->bigInteger('post_parent')->unsigned();
            $table->string('guid');
            $table->integer('menu_order');
            $table->string('post_type');
            $table->string('post_mime_type');
            $table->bigInteger('comment_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            Schema::dropIfExists('posts');
        });
    }
}
