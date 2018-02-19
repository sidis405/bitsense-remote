<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use DynamicBind;

    protected $guarded = [];

    protected $primaryKey = 'slug';

    public $incrementing = false;

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
