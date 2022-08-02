<?php

use Illuminate\Support\Facades\Route;
use App\Models\Staff;
use App\Models\Photo;

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
    $staff = Staff::findOrFail(1);
    $staff->photos()->create(['path' => 'userimage_1.jpg']);
});

Route::get('/read', function () {
    $staff = Staff::findOrFail(1);
    // dd($staff->photos);
    foreach ($staff->photos as $photo) {
        echo $photo->path . "<br>";
    }
});

Route::get('/update', function () {
    $staff = Staff::findOrFail(1);
    // return $staff->photos()->whereId(1)->update(['path'=>'updated.jpg']);
    $photo = $staff->photos()->whereId(1)->first();
    $photo->path = "superUpdated.jpg";
    $photo->save();
});

Route::get('/delete', function () {
    $staff = Staff::findOrFail(1);

    $staff->photos()->delete();
});

Route::get('/assign', function () {
    $staff = Staff::findOrFail(1);
    $photo = Photo::findOrFail(4);
    $staff->photos()->save($photo);
});

Route::get('/un-assign', function () {
    $staff = Staff::findOrFail(1);
    $staff->photos()->whereId(4)->update(['imageable_id' => 0, 'imageable_type' => 0]);
});
