<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFs extends Model
{
    use HasFactory;

    const FS_STATUS = [
        'completed'         => 'Completed',
        'ongoing'           => 'Ongoing',
        'for_preparation'   => 'For Preparation',
    ];
}
