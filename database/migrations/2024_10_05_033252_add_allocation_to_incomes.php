<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAllocationToIncomes extends Migration
{
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->decimal('primary_allocation', 8, 2)->nullable();
            $table->decimal('secondary_allocation', 8, 2)->nullable();
            $table->decimal('investment_allocation', 8, 2)->nullable();
            $table->decimal('debt_allocation', 8, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn(['primary_allocation', 'secondary_allocation', 'investment_allocation', 'debt_allocation']);
        });
    }
}