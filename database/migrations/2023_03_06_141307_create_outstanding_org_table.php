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
        Schema::create('outstanding_org', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('n_id')->nullable();
            $table->integer('projects_initiated')->nullable();
            $table->integer('awards_received')->nullable();
            $table->integer('community_involvement')->nullable();
            $table->integer('affiliation')->nullable();
            $table->integer('financial_statement')->nullable();
            $table->integer('total')->virtualAs('projects_initiated + awards_received + community_involvement + affiliation + financial_statement')->nullable();
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
        Schema::dropIfExists('outstanding_org');
    }
};
