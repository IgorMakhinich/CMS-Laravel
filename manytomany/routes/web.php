<?php

use App\Models\Role;
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

Route::get('/create-role-for-user-by-id/{id}', function ($id) {
    $user = User::findOrFail($id);
    $role = new Role(['name' => 'tester']);
    $user->roles()->save($role);
});

Route::get('/read-roles-of-user-by-id/{id}', function ($id) {
    $user = User::findOrFail($id);
    foreach ($user->roles as $key => $role) {
        // dd($role);
        echo $key . ' -> ' . $role->name . "<br>";
    }
});

Route::get('/update-role-of-user-by-id/{id}', function ($id) {
    $user = User::findOrFail($id);

    if ($user->has('roles')) {
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                $role->name = 'administrator';
                $role->save();
            }
        }
    }
});

Route::get('/delete-role-of-user-by-id/{id}', function ($id) {
    $user = User::findOrFail($id);

    foreach ($user->roles as $role) {
        if ($role->name == 'admin'){
            $role->delete();
        } else {
            echo 'not deleted ' . $role->name . "<br>";
        }
    }
});

Route::get('/attach', function(){
    $user = User::findOrFail(1);

    $user->roles()->attach(4);
});

Route::get('/detach', function(){
    $user = User::findOrFail(1);

    $user->roles()->detach(4);
});

Route::get('/detach-all', function(){
    $user = User::findOrFail(1);

    $user->roles()->detach();
});

Route::get('/sync', function(){
    $user = User::findOrFail(1);

    $user->roles()->sync([1,4]);
});