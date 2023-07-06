<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaDrive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_drive', function (Blueprint $table) {
            $table->id();

            $table->string('file_name', 255);
            $table->bigInteger('media_directory_id')->unsigned()->nullable();
            $table->bigInteger('media_type')->unsigned();
            $table->boolean('is_default')->default(false);
            $table->integer('media_size')->default(0);
            $table->integer('media_height')->default(0);
            $table->integer('media_width')->default(0);
            $table->string('media_title', 255)->nullable();
            $table->string('media_alt_text', 255)->nullable();
            $table->string('media_description', 255)->nullable();
            $table->string('media_mime_type', 255)->nullable();
            $table->string('media_extension', 40)->nullable();
            $table->string('media_url', 255)->nullable();
            $table->boolean('media_is_image')->default(false);
            $table->text('thumbnails')->nullable();
            $table->text('data')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);


            $table->foreign('media_type')->references('id')->on('media_types');
            $table->foreign('media_directory_id')->references('id')->on('media_directories')->onDelete('RESTRICT');

            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_drive');
    }
}
