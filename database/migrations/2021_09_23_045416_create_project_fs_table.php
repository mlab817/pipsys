<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_fs', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->enum('status', ['ongoing','completed','for_preparation'])->nullable();
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->decimal('y2016', 15, 4)->nullable()->default(0);
            $table->decimal('y2017', 15, 4)->nullable()->default(0);
            $table->decimal('y2018', 15, 4)->nullable()->default(0);
            $table->decimal('y2019', 15, 4)->nullable()->default(0);
            $table->decimal('y2020', 15, 4)->nullable()->default(0);
            $table->decimal('y2021', 15, 4)->nullable()->default(0);
            $table->decimal('y2022', 15, 4)->nullable()->default(0);
            $table->decimal('y2023', 15, 4)->nullable()->default(0);
            $table->decimal('y2024', 15, 4)->nullable()->default(0);
            $table->decimal('y2025', 15, 4)->nullable()->default(0);
            $table->decimal('y2026', 15, 4)->nullable()->default(0);
            $table->decimal('y2027', 15, 4)->nullable()->default(0);
            $table->decimal('y2028', 15, 4)->nullable()->default(0);
            $table->decimal('y2029', 15, 4)->nullable()->default(0);
            $table->decimal('y2030', 15, 4)->nullable()->default(0);
            $table->timestamps();

            $table->unique('project_id','project_fs_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_fs');
    }
}
