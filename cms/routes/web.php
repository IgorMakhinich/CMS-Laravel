<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\User;
use App\Models\Country;
use App\Models\Photo;
use App\Models\Tag;
use Carbon\Carbon;

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
| CRUD App
|--------------------------------------------------------------------------
|
*/

Route::resource('/posts', PostsController::class);

Route::get('/dates', function() {
    $date = new DateTime('+1 week');

    echo $date->format('d-m-Y');

    echo '<br>';

    echo Carbon::now()->addDays(8)->diffForHumans(); echo '<br>';

    echo '<br>';

    echo Carbon::now()->subMonth(5)->diffForHumans();
});

Route::get('/getname', function (){
    $user = User::find(1);
    echo $user->name;
});

Route::get('/setname', function(){
    $user = User::find(1);
    $user->name = 'changed_name';
    $user->save();
});
