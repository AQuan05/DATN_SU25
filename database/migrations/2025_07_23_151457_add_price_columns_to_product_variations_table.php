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
        Schema::table('product_variations', function (Blueprint $table) {
           $table->decimal('price', 15, 2)->nullable();
        $table->decimal('price_sale', 15, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variations', function (Blueprint $table) {
           $table->dropColumn(['price', 'price_sale']);
        });
    }
};
