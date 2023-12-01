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
        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->string('name')->nullable()->after('product_code');
            $table->string('supplier_internal_code')->nullable()->after('name');
            $table->string('tecdoc_code')->nullable()->after('supplier_internal_code');
            $table->string('category_name')->nullable()->after('tecdoc_code');
            $table->string('provider')->nullable()->after('category_name');
            $table->string('units')->nullable()->after('provider');
            $table->longText('ean')->nullable()->after('units');
            $table->string('origin')->nullable()->after('ean');
            $table->json('original_data')->nullable()->after('url');

            $table->dropColumn('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('supplier_internal_code');
            $table->dropColumn('tecdoc_code');
            $table->dropColumn('category_name');
            $table->dropColumn('provider');
            $table->dropColumn('units');
            $table->dropColumn('ean');
            $table->dropColumn('origin');
            $table->dropColumn('original_data');

            $table->double('price')->nullable()->after('product_code');



        });
    }
};
