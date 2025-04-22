<?php

namespace App\Helpers;

use App\Models\Series;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeriesHelpers
{
    public static function create_series()
    {
        Series::create([
            'title' => 'The Art of Coding',
            'description' => 'A series exploring the beauty and complexity of programming.',
            'image' => 'https://www.amazon.com/Art-Coding-Language-Graphics-Animation/dp/0367900378',
            'user_name' => 'Alice',
            'user_photo_url' => 'https://www.freepik.com/free-photos-vectors/default-user',
            'published_at' => now(),
        ]);

        Series::create([
            'title' => 'Nature Wonders',
            'description' => 'Discover the most breathtaking natural wonders around the world.',
            'image' => 'https://www.istockphoto.com/photos/natural-wonders',
            'user_name' => 'Bob',
            'user_photo_url' => 'https://www.freepik.com/free-photos-vectors/default-user',
            'published_at' => now(),
        ]);

        Series::create([
            'title' => 'Space Exploration',
            'description' => 'A journey through the history and future of space exploration.',
            'image' => 'https://commons.wikimedia.org/wiki/Commons:Featured_pictures/Space_exploration',
            'user_name' => 'Charlie',
            'user_photo_url' => 'https://www.freepik.com/free-photos-vectors/default-user',
            'published_at' => now(),
        ]);
    }

    public static function createSeriesPermissions()
    {
        // Define the permissions for managing series
        $permissions = [
            'series.view',
            'series.create',
            'series.edit',
            'series.delete',
        ];

        // Create the permissions if they don't already exist
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign the permissions to the superadmin role
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin']);
        $superAdminRole->syncPermissions($permissions);
    }
}
