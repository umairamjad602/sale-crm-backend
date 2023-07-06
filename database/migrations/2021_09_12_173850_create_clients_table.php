<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('Country')->nullable();
            $table->foreignId('assigned_to')->references('id')->on('users');
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('job_title')->nullable();
            $table->string('worl_email')->nullable();
            $table->string('work_phone')->nullable();
            $table->text('office_address')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('State')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('tax_reg')->nullable();
            $table->string('postal_codecountry')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
