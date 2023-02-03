<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->string('payment_type');
            $table->integer('user_id')->unsigned();
            $table->integer('receipt_no')->unique();
            $table->integer('items');
            $table->float('total_amount');
            $table->float('amount_tendered');
            $table->float('change');
            $table->string('status'); // Success, Failed
            $table->timestamps();

            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branch')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice');
    }
};
