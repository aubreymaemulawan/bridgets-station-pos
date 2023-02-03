<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            $table->integer('quantity');
            $table->float('price');
            $table->float('sub_total');
            $table->timestamps();

            $table->foreign('invoice_id')
                    ->references('id')
                    ->on('invoice')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('menu_id')
                    ->references('id')
                    ->on('menu')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
