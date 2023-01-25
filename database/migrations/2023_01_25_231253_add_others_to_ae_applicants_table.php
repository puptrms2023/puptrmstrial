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
        Schema::table('ae_applicants', function (Blueprint $table) {
            $table->unsignedBigInteger('reason')->nullable();
            $table->string('others', 255)->nullable();

            $table->foreign('reason')->references('id')->on('reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ae_applicants', function (Blueprint $table) {
            $table->dropColumn('reason');
            $table->dropColumn('others');
        });
    }
};
