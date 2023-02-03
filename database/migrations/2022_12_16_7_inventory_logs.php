<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InventoryLogs extends Migration {

    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_id')->unsigned();
            $table->integer('quantity')->unique();
            $table->integer('no_days')->unique();
            $table->date('date_start')->unique();
            $table->date('date_end')->unique();
            $table->timestamps();

            $table->foreign('inventory_id')
                    ->references('id')
                    ->on('inventory')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_logs');
    }
};
