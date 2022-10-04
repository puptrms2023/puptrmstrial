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
        Schema::table('non_academic_applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('org_id');
            $table->unsignedBigInteger('nonacad_id');
            $table->string('subject_name');
            $table->string('thesis_title');
            $table->string('sports');
            $table->string('competition_name');
            $table->string('placement');
            $table->string('designated_office');
            $table->string('remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('non_academic_applicants', function (Blueprint $table) {
            $table->dropColumn(['org_id',  'nonacad_id', 'subject_name', 'thesis_title', 'sports', 'competition_name', 'placement', 'designated_office', 'remarks']);
        });
    }
};
