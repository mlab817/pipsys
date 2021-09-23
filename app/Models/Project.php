<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    use HasUuid;

    protected static function booted()
    {
        static::addGlobalScope('user_type', function (Builder $builder) {
            // if user is not admin, return only projects belonging to the same office
            if (! auth()->user()->is_admin) {
                $builder->where('office_id', '=', auth()->user()->office_id);
            }
        });
    }

    public function description(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectDescription::class)
            ->withDefault(['description' => '_No description_']);
    }

    public function pap_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefPapType::class,'ref_pap_type_id')
            ->withDefault(['name' => 'N/A']);
    }
}
