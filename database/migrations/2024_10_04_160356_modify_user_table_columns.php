<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserTableColumns extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the columns if they exist
            $table->dropColumn(['gender', 'job', 'age']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Add the columns back as nullable
            $table->string('gender')->nullable();
            $table->string('job')->nullable();
            $table->integer('age')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the nullable columns
            $table->dropColumn(['gender', 'job', 'age']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Add the columns back as non-nullable
            $table->string('gender');
            $table->string('job');
            $table->integer('age');
        });
    }
}