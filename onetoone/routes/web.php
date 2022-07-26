<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Address;

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

Route::get('/insert/{id}', function ($id) {
    $user = User::findOrFail($id);

    $address = new Address(['name'=>'Kiev Kyrylivska 122/1']);

    $user->address()->save($address);
});

Route::get('/read/{id}', function($id) {
    $user = User::findOrFail($id);

    echo $user;
});

Route::get('/update/{id}', function ($id) {
    // $address = Address::where('user_id', $id);
    // $address = Address::where('user_id', '=', $id);
    $address = Address::whereUserId($id)->first();

    echo $address . "\n";
    
    $address->name = "Updated new address";
    
    $address->save();

});

Route::get('/delete/{id}', function($id) {
    $user = User::findOrFail($id);
    $user->address()->delete();
});
