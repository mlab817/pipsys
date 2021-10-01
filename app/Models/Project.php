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
        'pipol_code',
        'title',
        'ref_pap_type_id',
        'total_cost',
        'office_id',
        'ref_spatial_coverage_id',
        'iccable',
        'ref_gad_id',
        'approval_date',
        'pip',
        'ref_pip_typology_id',
        'cip',
        'ref_cip_type_id',
        'trip',
        'rdip',
        'rdc_endorsement_required',
        'rdc_endorsed',
        'rdc_endorsed_date',
        'research',
        'ifp',
        'ict',
        'covid',
        'icc_resubmission',
        'target_start_year',
        'target_end_year',
        'pdp_chapter_id',
        'no_pdp_indicator',
        'ref_prep_document_id',
        'has_fs',
        'has_row',
        'has_rap',
        'has_row_rap',
        'employment_generated',
        'ref_fund_source_id',
        'ref_funding_institution_id',
        'ref_implementation_mode_id',
        'other_mode',
        'financial_accomp_na',
        'pap_code',
        'ref_tier_id',
        'uacs_code',
        'nep',
        'gaa',
        'disbursement',
        'infra_sectors',
        'prerequisites',
        'risk',
    ];

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    protected static function booted()
    {
        static::addGlobalScope('user_type', function (Builder $builder) {
            // if user is not admin, return only projects belonging to the same office
            if (auth()->user() && ! auth()->user()->is_admin) {
                $builder->where('office_id', '=', auth()->user()->office_id)
                    ->orWhere('creator_id', auth()->id());
            }
        });
    }

    public function covid_interventions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefCovidType::class, 'project_covid_type');
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

    public function risk(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectRisk::class)
            ->withDefault(['risk' => '_No risk_']);
    }

    public function pap_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefPapType::class,'ref_pap_type_id')
            ->withDefault(['name' => 'N/A']);
    }

    public function feasibility_study(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectFs::class);
    }

    public function gaa(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectGaa::class);
    }

    public function output(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectOutput::class);
    }

    public function disbursement(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectDisbursement::class);
    }

    public function fund_source(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(RefFundSource::class);
    }

    public function nep(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectNep::class);
    }

    public function project_update(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectUpdate::class);
    }

    public function resettlement_action_plan(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectResettlement::class);
    }

    public function rowa(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProjectRowa::class);
    }

    public function bases(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefBasis::class, 'project_basis', 'ref_basis_id', 'project_id');
    }

    public function infra_sectors(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefInfraSector::class, 'project_infra_sec');
    }

    public function operating_units(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefOperatingUnit::class, 'project_ou', 'ref_operating_unit_id','project_id');
    }

    public function pdp_chapters(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefPdpChapter::class, 'project_pdp_chapter', 'ref_pdp_chapter_id','project_id');
    }

    public function pdp_indicators(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefPdpIndicator::class, 'project_pdp_indicator', 'ref_pdp_indicator_id','project_id');
    }

    public function prerequisites()
    {
        return $this->belongsToMany(RefPrerequisite::class,'project_prerequisite');
    }

    public function regions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefRegion::class, 'project_region', 'ref_region_id', 'project_id');
    }

    public function sdgs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefSustainableDevtAgenda::class, 'project_sdg');
    }

    public function socio_econ_agendas(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(RefSocioEconAgenda::class, 'project_sea');
    }

    public function fs_investments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectFsInvestment::class);
    }

    public function fs_infrastructures(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectFsInfrastructure::class);
    }

    public function region_investments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectRegionInvestment::class);
    }

    public static function search($query): Builder
    {
        return empty($query) ? static::query()
            : static::where(function($q) use ($query) {
                $q->where('title', 'LIKE', '%'. $query . '%');
            });
    }
}
