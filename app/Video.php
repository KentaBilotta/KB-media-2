<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function playlists() {
        return $this->belongsToMany('App\Playlist');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    protected $fillable = [
        'title', 'video_path'
    ];
}
