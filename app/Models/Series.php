<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    // Define fillable fields
    protected $fillable = [
        'title',
        'description',
        'image',
        'user_name',
        'user_photo_url',
        'published_at',
    ];

    /**
     * Relationship: Series has many Videos (1:N).
     */
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Relationship: Series is tested by a User.
     */
    public function testedBy()
    {
        return $this->belongsTo(User::class, 'user_name', 'name');
    }

    /**
     * Accessor: Get formatted created_at date.
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Accessor: Get created_at date in human-readable format.
     */
    public function getFormattedForHumansCreatedAtAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Accessor: Get created_at as a timestamp.
     */
    public function getCreatedAtTimestampAttribute()
    {
        return $this->created_at->timestamp;
    }
}
