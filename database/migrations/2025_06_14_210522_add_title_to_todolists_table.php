<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('todolists', function (Blueprint $table) {
        $table->string('title')->after('id'); // или любое другое место
    });
}

public function down()
{
    Schema::table('todolists', function (Blueprint $table) {
        $table->dropColumn('title');
    });
}
};
