<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('pipol_code')->nullable();
            $table->text('title');
            $table->foreignId('ref_pap_type_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('regular_program')->nullable()->default(0);
            $table->decimal('total_cost', 15, 4)->nullable()->default(0);
            $table->foreignId('office_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ref_spatial_coverage_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('iccable')->nullable()->default(0);
            $table->foreignId('ref_approval_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ref_gad_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('pip')->nullable()->default(0);
            $table->foreignId('ref_pip_typology_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('cip')->nullable()->default(0);
            $table->foreignId('ref_cip_type_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('trip')->nullable()->default(0);
            $table->boolean('rdip')->nullable()->default(0);
            $table->boolean('rdc_endorsement_required')->nullable()->default(0);
            $table->boolean('rdc_endorsed')->nullable()->default(0);
            $table->date('rdc_endorsed_date')->nullable();
            $table->boolean('research')->nullable()->default(0);
            $table->boolean('ict')->nullable()->default(0);
            $table->boolean('ifp')->nullable()->default(0);
            $table->boolean('covid')->nullable()->default(0);
            $table->boolean('icc_resubmission')->nullable()->default(0);
            $table->year('target_start_year')->nullable();
            $table->year('target_end_year')->nullable();
            $table->foreignId('ref_pdp_chapter_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('no_pdp_indicator')->nullable()->default(0);
            $table->foreignId('ref_prep_document_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('has_row')->nullable()->default(0);
            $table->boolean('has_rap')->nullable()->default(0);
            $table->boolean('has_row_rap')->nullable()->default(0);
            $table->string('employment_generated')->nullable();
            $table->foreignId('ref_fund_source_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ref_implementation_mode_id')->nullable()->constrained()->nullOnDelete();
            $table->string('other_mode')->nullable();
            $table->boolean('financial_accomp_na')->nullable()->default(0);
            $table->foreignId('ref_tier_id')->nullable()->constrained()->nullOnDelete();
            $table->string('uacs_code')->nullable();
            $table->string('pap_code')->nullable();
            $table->foreignId('creator_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('ref_version_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('original_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->foreignId('ref_project_status_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('ref_submission_status_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
