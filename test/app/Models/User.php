<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // !One to One relationship

    public function post()
    {
        // Default return
        // return $this->hasOne('App\Models\Post');

        // Return with params
        return $this->hasOne('App\Models\Post', 'user_id', 'id');
    }

    // !One to many relationship

    public function posts()
    {
        // Default return
        // return $this->hasMany('App\Models\Post');

        // Return with params
        return $this->hasMany('App\Models\Post', 'user_id', 'id');
    }

    // !Many to many relations

    public function roles()
    {
        // Default return
        return $this->belongsToMany('App\Models\Role')->withPivot('created_at');

        // Return with params
        // return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }


    // !Polymorphic relation
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
}
