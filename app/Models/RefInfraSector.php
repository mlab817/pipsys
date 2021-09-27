<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefInfraSector extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function infra_subsectors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RefInfraSubsector::class);
    }
}
