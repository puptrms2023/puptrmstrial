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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('n_id')->nullable();
            $table->string('awards')->nullable();
            $table->string('awarded_by')->nullable();
            $table->string('date_received')->nullable();
            $table->string('level')->nullable();
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
        Schema::dropIfExists('awards');
    }
};
