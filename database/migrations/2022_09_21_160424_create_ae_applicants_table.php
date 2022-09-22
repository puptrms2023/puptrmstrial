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
        Schema::create('ae_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->string('school_year');
            $table->string('award_applied');
            $table->string('year_level');
            $table->decimal('gwa1', 10, 2);
            $table->decimal('gwa2', 10, 2);
            $table->decimal('gwa3', 10, 2);
            $table->decimal('gwa4', 10, 2);
            $table->decimal('gwa', 10, 2)->virtualAs('(gwa1 + gwa2 + gwa3 + gwa4)/4')->nullable();
            $table->tinyInteger('status')->default('0')->comment('0=Pending,1=Accepted,2=Rejected');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ae_applicants');
    }
};
