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
            $table->tinyInteger('certificate_status')->default('0')->comment('0=pending,1=sent');
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
            $table->dropColumn('certificate_status');
        });
    }
};
