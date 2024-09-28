<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToTourGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_guides', function (Blueprint $table) {
            // إضافة عمود phone
            $table->string('phone', 40)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tour_guides', function (Blueprint $table) {
            // حذف عمود phone
            $table->dropColumn('phone');
        });
    }
}
