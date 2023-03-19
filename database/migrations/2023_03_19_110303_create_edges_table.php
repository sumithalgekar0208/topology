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
        Schema::create('edges', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('color');
            $table->bigInteger('from')->unsigned();
            $table->bigInteger('to')->unsigned();
            $table->boolean('has_dashed');
            $table->boolean('is_connected')->default(true);
            $table->timestamps();
            $table->foreign('from')->references('id')->on('devices')->onDelete('cascade');
            $table->foreign('to')->references('id')->on('devices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edges');
    }
};
