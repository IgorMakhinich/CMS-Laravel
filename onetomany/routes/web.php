<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/create/{id}', function ($id) {
    $user = User::findOrFail($id);

    $post = new Post(['title' => 'New Post Title3', 'body' => 'New Body Title3']);

    $user->posts()->save($post);
});

Route::get('read/{id}', function ($id) {
    $user = User::findOrFail($id);

    // dd($user->posts);

    foreach ($user->posts as $post) {
        echo $post->title . "<br>";
    }
});

Route::get('update/{id}/{post_id}', function ($id, $post_id) {
    $user = User::findOrFail($id);

    // dd($user->posts);
    // return $user->posts()->whereId($post_id)->update(['title'=>'Title ' . $post_id . 'has updated']);
    return $user->posts()->where('id','=',$post_id)->update(['title'=>'Title ' . $post_id . 'has updated']);
});

Route::get('delete/{user_id}/{post_id}', function($user_id, $post_id) {
    $user = User::findOrFail($user_id);

    return $user->posts()->whereId($post_id)->delete();
});
