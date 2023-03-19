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
        Schema::table('edges', function (Blueprint $table) {
            $table->float('utilization', 8, 2)->nullable();
            $table->dropColumn('has_dashed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('edges', function (Blueprint $table) {
            $table->dropColumn('utilization');
            $table->boolean('has_dashed');
        });
    }
};
