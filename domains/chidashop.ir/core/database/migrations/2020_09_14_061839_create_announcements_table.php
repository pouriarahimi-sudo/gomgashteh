<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{

    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('collection_id');
            $table->text('detail');
            $table->string('pictures')->nullable();
            $table->integer('type');
            $table->unsignedBigInteger('announcer_id');
            $table->integer('status')->default('0');
            $table->text('number_of_edits')->nullable();
            $table->integer('result')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('announcements');
    }
}
