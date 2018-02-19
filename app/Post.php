<?php

namespace App;

use App\Events\PostWasCreated;
use App\Events\PostWasUpdated;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use DynamicBind;

    protected $guarded = [];

    protected $primaryKey = 'slug';

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        // static::created(function ($post) {
        //     event(new PostWasCreated($post));
        // });

        static::saved(function ($post) {
            event(new PostWasUpdated($post));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = str_slug($title);
    }
}
