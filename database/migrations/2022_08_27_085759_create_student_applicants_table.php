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
        Schema::create('student_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('stud_num');
            $table->string('year_level');
            $table->string('award_applied');
            $table->decimal('curriculum_eval', 10, 2);
            $table->decimal('firstsem_gwa', 10, 2);
            $table->decimal('secondsem_gwa', 10, 2);
            $table->decimal('average_gwa', 10, 2);
            $table->string('image');
            $table->tinyInteger('status')->default('0')->comment('0=Pending,1=Accepted,2=Rejected');
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
        Schema::dropIfExists('student_applicants');
    }
};
