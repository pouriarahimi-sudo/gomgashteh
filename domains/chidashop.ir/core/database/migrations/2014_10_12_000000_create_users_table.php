<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',60);
            $table->string('last_name',60);
            $table->string('phone_num',11);
            $table->string('national_code',10)->nullable();
            $table->string('gender')->nullable();
            $table->string('birthday',10)->nullable();
            $table->string('tell',11)->nullable();
            $table->text('email')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code',10)->nullable();
            $table->text('user_pic')->nullable();
            $table->string('financial_situation',10)->nullable();
            $table->string('user_status')->nullable();
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
        Schema::dropIfExists('users');
    }
}
