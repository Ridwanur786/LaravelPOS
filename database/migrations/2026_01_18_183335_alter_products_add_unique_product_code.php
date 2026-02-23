<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Drop existing columns
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['product_code', 'barcode']);
        });

        // Recreate with correct constraints
        Schema::table('products', function (Blueprint $table) {
            $table->string('product_code')->nullable()->unique();
            $table->longText('barcode')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropUnique('products_product_code_unique');
            $table->dropColumn(['product_code', 'barcode']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('product_code')->default('');
            $table->longText('barcode')->default('');
        });
    }
};
