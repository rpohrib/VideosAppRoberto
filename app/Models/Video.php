<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Video extends Model
{
    protected $fillable = [
        'title', 'description', 'url', 'published_at', 'previous', 'next', 'series_id', 'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $dates = ['published_at'];

    /**
     * Get the formatted published_at date.
     *
     * @return string
     */
    public function getFormattedPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->translatedFormat('j \d\e F \d\e Y');
    }

    /**
     * Get the published_at date formatted for humans.
     *
     * @return string
     */
    public function getFormattedForHumansPublishedAtAttribute()
    {
        return Carbon::parse($this->published_at)->diffForHumans();
    }

    /**
     * Get the Unix timestamp of the published_at date.
     *
     * @return int
     */
    public function getPublishedAtTimestampAttribute()
    {
        return Carbon::parse($this->published_at)->timestamp;
    }
}
