<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostCreated;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'name', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function($post) {
            Mail::to($post->user->email)->send(
                new PostCreated($post)
            );
        });

    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)->locale('fr')->diffForHumans(Carbon::now());
    }
}