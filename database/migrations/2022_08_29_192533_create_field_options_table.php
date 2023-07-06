<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')->references('id')->on('field_option_types');
            $table->string('name', 255);
            $table->string('short_name')->nullable();
            $table->text('description')->nullable();
            $table->string('payload', 255)->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('field_options');
    }
}
