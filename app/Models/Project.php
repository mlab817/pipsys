<?php

namespace App\Models;

use App\Traits\HasUuid;
use Bkwld\Cloner\Cloneable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Project extends Model
{
    use HasFactory;
    use HasUuid;
    use Cloneable;
    use RevisionableTrait;

    protected $fillable = [
        'title',
        'ref_pap_type_id',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::addGlobalScope('user_type', function (Builder $builder) {
            // if user is not admin, return only projects belonging to the same office
            if (! auth()->user()->is_admin) {
                $builder->where('office_id', '=', auth()->user()->office_id)
                    ->orWhere('creator_id', auth()->id());
            }
        });
    }

    public function creator(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class,'creator_id');
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

    public function gaa(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectGaa::class);
    }

    public function disbursement(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectDisbursement::class);
    }

    public function nep(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectNep::class);
    }

    public function bases(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefBasis::class, 'project_basis', 'ref_basis_id', 'project_id');
    }

    public function operating_units(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefOperatingUnit::class, 'project_ou', 'ref_ou_id','project_id');
    }

    public function regions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefRegion::class, 'project_region', 'ref_region_id', 'project_id');
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query()
            : static::where(function($q) use ($query) {
                $q->where('title', 'LIKE', '%'. $query . '%');
            });
    }
}
