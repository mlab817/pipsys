<?php

namespace App\Models;

use App\Http\Controllers\ProjectController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::addGlobalScope('user_type', function (Builder $builder) {
            // if user is not admin, return only projects belonging to the same office
            if (! auth()->user()->is_admin) {
                $builder->where('office_id', '=', auth()->user()->office_id);
            }
        });
    }
}
