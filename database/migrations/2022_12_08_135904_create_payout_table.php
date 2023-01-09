<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payout', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');            
            $table->string('period')->nullable();
            $table->float('amount', 8, 2);
            $table->integer('percent');
            $table->float('balance', 8, 2);
            $table->float('income', 8, 2);
            $table->string('valute', 3);
            $table->string('payment_system', 255)->nullable();
            $table->string('wallet', 255);
            $table->string('description', 255)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payout');
    }
}
