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

    protected $fillable = [
        'status',
        'start_date',
        'completion_date',
        'y2017',
        'y2018',
        'y2019',
        'y2020',
        'y2021',
        'y2022',
    ];
}
