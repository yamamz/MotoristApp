<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeForeignOnTransactionRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_records', function(Blueprint $table)
        {
            $table->dropColumn('accounting_transaction_id');
            });
        Schema::table('transaction_records', function(Blueprint $table)
        {
            $table->unsignedBigInteger('accounting_transaction_id');
             $table->foreign('accounting_transaction_id')->references('id')->on('accounting_transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_records', function(Blueprint $table)
        {
    
        $table->dropForeign('accounting_transaction_id'); //
        });
    }
}
