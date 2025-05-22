<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', // 'video' or 'photo'
        'path',
        'user_id',
    ];

    /**
     * Get the user that owns the multimedia file.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
