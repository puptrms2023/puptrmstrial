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
        Schema::create('academics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('n_id')->nullable();
            $table->float('first_year_first')->nullable();
            $table->float('first_year_second')->nullable();
            $table->float('second_year_first')->nullable();
            $table->float('second_year_second')->nullable();
            $table->float('third_year_first')->nullable();
            $table->float('third_year_second')->nullable();
            $table->float('fourth_year_first')->nullable();
            $table->float('fourth_year_second')->nullable();
            $table->float('fifth_year_first')->nullable();
            $table->float('fifth_year_second')->nullable();
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
        Schema::dropIfExists('academics');
    }
};
