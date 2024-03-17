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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ratesId')->unsigned()->index();
            $table->foreign('ratesId')->references('id')->on('rate')->onDelete('cascade');
            $table->char('currency', 3)->index();
            $table->float('rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_rates');
    }
};
