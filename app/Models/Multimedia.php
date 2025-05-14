<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'multimedia';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'type',
        'path',
    ];
}
