<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Country extends Model
{
    use HasFactory;

    public function posts()
    {
        // Default return
        return $this->HasManyThrough('App\Models\Post', 'App\Models\User');

        // Return with params
        // return $this->HasManyThrough('App\Post', 'App\User', 'country_id', 'user_id');
    }
}
