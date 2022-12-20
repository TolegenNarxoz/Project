<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_kz');
            $table->string('name_en');
            $table->string('name_ru');
        });
    }


    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_kz');
            $table->dropColumn('name_en');
            $table->dropColumn('name_ru');
        });
    }
};
