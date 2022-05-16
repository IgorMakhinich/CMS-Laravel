<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\DB;
use App\Models\Post;

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


/*
|--------------------------------------------------------------------------
| Basic Routes
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return "Hi about page";
});


Route::get('/contact', function () {
    return "hi I am contact";
});

Route::get('/post/{id}/{name}', function ($id, $name) {
    return "This is post number " . $id . " " . $name;
});


/*
|--------------------------------------------------------------------------
| Naming Routes
|--------------------------------------------------------------------------
*/

Route::get('admin/posts/example', array('as' => 'admin.home', function () {
    $url = route('admin.home');
    return "this url is " . $url;
}));


/*
|--------------------------------------------------------------------------
| Routing controllers + passing data made controller  PostController.php
|--------------------------------------------------------------------------
*/

Route::get('post/{id}', [PostsController::class, 'index']);


/*
|--------------------------------------------------------------------------
| Routing resource
|--------------------------------------------------------------------------
*/

Route::resource('posts', PostsController::class);


/*
|--------------------------------------------------------------------------
| View made post.blade.php in views
|--------------------------------------------------------------------------
*/

Route::get('contact', [PostsController::class, 'contact']);


/*
|--------------------------------------------------------------------------
| View passing data
|--------------------------------------------------------------------------
*/


Route::get('post/{id}/{name}/{password}', [PostsController::class, 'show_post']);

/*
|--------------------------------------------------------------------------
| Migrations
|--------------------------------------------------------------------------
*/

// php artisan make:migration create_post_table --create="posts"
// php artisan make:migration add_is_admin_to_posts_table --table="posts"

/*
|--------------------------------------------------------------------------
| RAW SQL Queries
|--------------------------------------------------------------------------
*/

// use Illuminate\Support\Facades\DB;

// !create data
Route::get('insert-raw/{title}/{content}', function ($title, $content) {
    DB::insert('insert into posts (title, content) values (?, ?)', [$title, $content]);
});

// !reading data
Route::get('read-all', function () {
    $posts = DB::select('select * from posts');
    foreach ($posts as $post) {
        echo $post->title . ': ' . $post->content . '<br>';
    }
});

Route::get('read-by-id/{id}', function ($id) {
    return DB::select('select * from posts where id = ?', [$id]);
});

// !update data
Route::get('update-by-id/{id}/{data}', function ($id, $data) {
    return DB::update('update posts set content = ? where id = ?', [$data, $id]);
});

// !delete data
Route::get('delete-by-id/{id}', function ($id) {
    return DB::delete('delete from posts where id = ?', [$id]);
});

/*
|--------------------------------------------------------------------------
| Database - Eloquent  / ORM
|--------------------------------------------------------------------------
*/

// !Reading data

// php artisan make:model Post
// use App\Models\Post;
Route::get('read-all-posts', function () {
    $posts = Post::all();
    foreach ($posts as $post) {
        echo $post->title . ' ' . $post->content . '<br>';
    }
});

Route::get('find-by-id/{id}', function ($id) {
    $post = Post::find($id);
    echo $post->title . ' ' . $post->content;
});

// !Finding with Constraints

Route::get('findwhere', function () {
    $posts = Post::where('id', 3)->orderBy('id', 'desc')->take(1)->get();
    return  $posts;
});

Route::get('findmore', function () {
    $posts = Post::where('users_count', '<', 50)->firstOrFail();
    foreach ($posts as $post) {
        echo $post->title . ' ' . $post->content . '<br>';
    }
});

Route::get('findorfail', function () {
    $posts = Post::findOrFail(1);
    return $posts;
});

// !Inserting / Saving Data

Route::get('basicinsert/{title}/{content}', function ($title, $content) {
    $post = new Post();

    $post->title = $title;
    $post->content = $content;

    $post->save();
});

Route::get('basicupdate/{id}/{title}/{content}', function ($id, $title, $content) {
    $post = Post::find($id);

    $post->title = $title;
    $post->content = $content;

    $post->save();
});

// !Creating data and configuring mass assignment

Route::get('create/{title}/{content}', function ($title, $content) {
    Post::create(['title' => $title, 'content' => $content]);
});

// !Updating with Eloquent

Route::get('update/{id}/{title}/{content}', function ($id, $title, $content) {
    Post::where('id', $id)->update(['title' => $title, 'content' => $content]);
});

// !Deleting data

Route::get('delete/{id}', function ($id) {
    $post = Post::find($id);
    $post->delete();
});

Route::get('delete2', function () {
    Post::destroy([3, 5]);
    //   Post::where('is_admin', 0)->delete();
});

// !Soft Deleting / Trashing

// use Illuminate\Database\Eloquent\SoftDeletes;
// use SoftDeletes;
// protected $data
// php artisan make:migration add_deleted_at_column_to_posts_table --table="posts"

Route::get('softdelete/{id}', function ($id) {
    Post::find($id)->delete();
});

// !Retrieving deleted / trashed records

Route::get('readsoftdelete', function () {
    // can't find trashed
    // $post = Post::find(2);
    // return $post;

    // find trashed and no trashed
    // $post = Post::withTrashed()->get();
    // return $post;

    //find only trashed
    $post = Post::onlyTrashed()->get();
    return $post;
});

// !Restoring deleted / trashed records

Route::get('restore/{id}', function ($id) {
    Post::onlyTrashed($id)->restore();
});

// !Deleting a record permanently

Route::get('forcedelete/{id}', function ($id) {
    Post::onlyTrashed($id)->forceDelete();
});
