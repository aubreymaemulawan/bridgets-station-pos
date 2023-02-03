<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_no')->unique();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->string('name')->unique();
            $table->integer('age');
            $table->bigInteger('contact_no');
            $table->string('gender');
            $table->string('address');
            $table->date('birthday');
            $table->date('date_started')->nullable();
            $table->date('date_ended')->nullable();
            $table->string('personal_email');
            $table->string('user_type'); // Admin, Staff
            $table->string('status'); // Active, Not Active
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_name')->nullable();
            $table->string('profile_path')->nullable();
            $table->string('password_decrypted');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
