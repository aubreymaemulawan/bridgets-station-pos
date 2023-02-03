<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->string('transaction_no');
            $table->string('status'); // Success, Failed
            $table->timestamps();

            $table->foreign('invoice_id')
                    ->references('id')
                    ->on('invoice')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
       
    }

    public function down()
    {
        Schema::dropIfExists('transaction');
    }
};
