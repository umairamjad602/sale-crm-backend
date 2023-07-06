<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaDriveRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media_drive_relations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('media_id')->unsigned();
            $table->bigInteger('module_id')->unsigned();
            $table->bigInteger('relation_id');

            $table->timestamps();

            $table->foreign('media_id','mdr_media_id')->references('id')->on('media_drive');
            $table->foreign('module_id', 'mdr_module_id')->references('id')->on('modules');
            $table->softDeletes();

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
        Schema::dropIfExists('media_drive_relations');
    }
}
