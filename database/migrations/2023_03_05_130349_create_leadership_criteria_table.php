<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leadership_criteria', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('n_id')->nullable();
            $table->integer('academic_performance')->nullable();
            $table->integer('projects_initiated')->nullable();
            $table->integer('officership')->nullable();
            $table->integer('awards_received')->nullable();
            $table->integer('community_outreach')->nullable();
            $table->integer('interview')->nullable();
            $table->integer('total')->virtualAs('academic_performance + projects_initiated + officership + awards_received + community_outreach + interview')->nullable();
            $table->timestamps();

            $table->foreign('n_id')->references('id')->on('non_academic_applicants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leadership_criteria');
    }
};
