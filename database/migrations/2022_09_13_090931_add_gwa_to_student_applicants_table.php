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
        Schema::table('student_applicants', function (Blueprint $table) {
            $table->decimal('gwa', 10, 2)->virtualAs('(gwa_1st + gwa_2nd)/2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_applicants', function (Blueprint $table) {
            $table->dropColumn('gwa');
        });
    }
};
