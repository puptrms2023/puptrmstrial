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
        Schema::create('summary_ae', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subject_id');
            $table->tinyInteger('term');
            $table->integer('units');
            $table->decimal('grades', 10, 2);
            $table->string('sy');
            $table->timestamps();
            $table->foreign('app_id')->references('id')->on('ae_applicants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('summary_ae', function (Blueprint $table) {
            $table->dropForeign(['foreign_key_column']);
        });
        Schema::dropIfExists('summary_ae');
    }
};
