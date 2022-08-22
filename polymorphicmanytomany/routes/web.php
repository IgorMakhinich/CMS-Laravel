<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create', function () {
    $post = Post::create(['name' => 'My First Post']);
    $tag1 = Tag::find(1);

    $post->tags()->save($tag1);

    $video = Video::create(['name' => 'video.mov']);
    $tag2 = Tag::find(2);

    $video->tags()->save($tag2);
});

Route::get('/read', function () {
    $post = Post::findOrFail(1);

    foreach ($post->tags as $tag) {
        echo $tag;
    }

});

Route::get('/update', function () {
    // version 1

    // $post = Post::findOrFail(1);
    // foreach ($post->tags as $tag) {
    //     $tag->whereName('PHP')->update(['name' => 'Laravel']);
    // }

    // version 2

    // $post = Post::findOrFail(1);
    // $tag = Tag::find(4);
    // $post->tags()->save($tag);

    // version 3

    // $post = Post::findOrFail(1);
    // $tag = Tag::find(2);
    // $post->tags()->attach($tag);

    // version 4

    $post = Post::findOrFail(1);
    $post->tags()->sync([1, 2]);
});

Route::get('/delete', function () {
    $post = Post::findOrFail(1);

    foreach ($post->tags as $tag) {
        $tag->whereId(2)->delete();
    }
});
