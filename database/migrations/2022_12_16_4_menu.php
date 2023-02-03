<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Menu extends Migration {

    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('menu_code')->unique();
            $table->string('menu_name');
            $table->float('price');
            $table->integer('servings');
            $table->string('status'); // Active, Not Active
            $table->string('photo_name')->nullable();
            $table->string('photo_path')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branch')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('category_id')
                    ->references('id')
                    ->on('category')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
