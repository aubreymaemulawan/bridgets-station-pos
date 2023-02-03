<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Branch extends Migration {

    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location')->unique();
            $table->string('branch_name')->unique();
            $table->string('status'); // Active, Not Active
            $table->bigInteger('contact_no');
            $table->string('email');
            $table->string('logo_name')->nullable();
            $table->string('logo_path')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('branch');
    }
};
