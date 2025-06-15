<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
{
    \DB::statement("ALTER TABLE todolists MODIFY completed TINYINT(1) NOT NULL DEFAULT '0'");
}

public function down()
{
    \DB::statement("ALTER TABLE todolists MODIFY completed TINYINT(1) NULL DEFAULT NULL");
}
};
