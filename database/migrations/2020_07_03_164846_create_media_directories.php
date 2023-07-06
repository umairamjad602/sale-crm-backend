<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaDirectories extends Migration
{
    public function up()
    {
        Schema::create('media_directories', function (Blueprint $table) {
            $table->id();

            $table->string('name',255);
            $table->string('location', 255);
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->softDeletes('deleted_at', 0);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_directories');
    }
}
