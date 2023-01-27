<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    //if another
    // protected $table = 'posts';
    // protected $primarykey = 'id';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'content',
    ];


    //inverse one-to-one relationship
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // !Polymorphic relation
    public function photos()
    {
        return $this->morphMany('App\Models\Photo', 'imageable');
    }

    // !Polymorphic relation many to many
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }

    public static function scopeList($query)
    {
        return $query->orderBy('id', 'desc')->get();
    }
}
