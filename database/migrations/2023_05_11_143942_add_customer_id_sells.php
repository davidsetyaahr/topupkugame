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
            $table->dropColumn('phone');
            $table->bigInteger('customer_id')->unsigned()->after('code')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            $table->string('phone')->after('code');
            $table->dropForeign('sells_customer_id_foreign');
            $table->dropColumn('customer_id');
            //
        });
    }
};
