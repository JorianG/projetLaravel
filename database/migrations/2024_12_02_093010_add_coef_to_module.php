<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('module', function (Blueprint $table) {
            $table->decimal('coefficient', 4, 2)->default(1.00);
        });
    }

    public function down()
    {
        Schema::table('module', function (Blueprint $table) {
            $table->dropColumn('coefficient');
        });
    }
};