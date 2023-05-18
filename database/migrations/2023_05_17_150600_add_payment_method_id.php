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
        Schema::table('sells', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->bigInteger('payment_method_id')->nullable()->unsigned();
            
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            $table->string('payment_method');
            $table->dropForeign('sells_payment_method_id_foreign');
            $table->dropColumn('payment_method_id');
            //
        });
    }
};
