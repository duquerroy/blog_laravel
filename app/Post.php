<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['title', 'content'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->locale('fr')->diffForHumans(Carbon::now());
    }
}