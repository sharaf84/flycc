<?php

use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider', 50);
            $table->decimal('amount', 8, 2);
            $table->char('currency', 3);
            $table->enum('status_code', Transaction::getStatusCodeList());
            $table->string('order_reference', 50);
            $table->string('transaction_id', 50);
            /**
             * Creating Indexes.
             */
            $table->unique('transaction_id');
            $table->index('amount');
            $table->index('currency');
            $table->index('status_code');
            $table->index(['amount', 'currency', 'status_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
