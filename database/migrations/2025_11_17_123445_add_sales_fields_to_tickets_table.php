<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->integer('max_purchase_per_user')->nullable()->after('quota');
            $table->dateTime('sale_start_date')->nullable()->after('max_purchase_per_user');
            $table->dateTime('sale_end_date')->nullable()->after('sale_start_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['max_purchase_per_user', 'sale_start_date', 'sale_end_date']);
        });
    }
};
