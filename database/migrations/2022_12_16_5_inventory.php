<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Inventory extends Migration {

    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->string('product_name');
            $table->string('measurement');
            $table->float('quantity');
            $table->price('price');
            $table->float('remaining');
            $table->timestamps();

            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branch')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory');
    }
};
