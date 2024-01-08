<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_products_prices', function (Blueprint $table) {
            $table->double('price', 16, 4)->change();
            $table->unsignedBigInteger('supplier_product_id')->nullable()->change();
            $table->string('supplier_product_identifier')->unique()->after('supplier_product_id');
        });

        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->string('supplier_product_identifier')->unique()->after('supplier_internal_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_products_prices', function (Blueprint $table) {
            $table->dropColumn('supplier_product_identifier');
            $table->string('price')->change();
            $table->unsignedBigInteger('supplier_product_id')->change();
        });

        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->dropColumn('supplier_product_identifier');
        });
    }
};
