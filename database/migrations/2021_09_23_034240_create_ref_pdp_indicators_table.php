<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPdpIndicatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_pdp_indicators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label');
            $table->string('description')->nullable();
            $table->unsignedInteger('level')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('ref_pdp_indicators')->nullOnDelete();
            $table->foreignId('ref_pdp_chapter_id')->nullable()->constrained('ref_pdp_chapters')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_pdp_indicators');
    }
}
