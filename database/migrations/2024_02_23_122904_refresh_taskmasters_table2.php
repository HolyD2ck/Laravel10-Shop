<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('taskmasters', function (Blueprint $table) {
            if (Schema::hasColumn('taskmasters', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('taskmaster_id')->nullable()->constrained('taskmasters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['taskmaster_id']);
            $table->dropColumn('taskmaster_id');
        });

        Schema::table('taskmasters', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
        });
    }
    
};
