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
            $table->decimal('gwa5', 10, 2);
            $table->decimal('gwa6', 10, 2);
            $table->decimal('gwa7', 10, 2);
            $table->decimal('gwa8', 10, 2);
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
            $table->dropColumn('gwa5');
            $table->dropColumn('gwa6');
            $table->dropColumn('gwa7');
            $table->dropColumn('gwa8');
        });
    }
};
