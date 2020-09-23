<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{

    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',60);
            $table->string('last_name',60);
            $table->string('national_code',10)->nullable(false);
            $table->string('phone_num',11);
            $table->string('status')->default('1');
            $table->string('father_name',60)->nullable();
            $table->string('birthday',10)->nullable();
            $table->string('gender')->nullable();
            $table->string('tell',11)->nullable();
            $table->string('marital_status')->nullable();
            $table->text('email')->nullable();
            $table->unsignedBigInteger('province_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code',10)->nullable();
            $table->text('admin_pic')->nullable();
            $table->string('financial_situation',10)->nullable();
            $table->integer('access_type');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
