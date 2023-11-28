<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers_products', function (Blueprint $table) {
            $table->double('price', 10, 4)->nullable()->after('product_code');
            $table->string('availability')->nullable()->after('price');
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
            $table->dropColumn('price');
            $table->dropColumn('availability');
        });
    }
};
