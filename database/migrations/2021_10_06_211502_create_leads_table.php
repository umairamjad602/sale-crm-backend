<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('primary_email');
            $table->string('primary_phone')->nullable();
            $table->string('secondary_phone')->nullable();
            $table->string('mobile')->nullable();
            $table->text('description')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('ip')->nullable();
            $table->string('secondary_email')->nullable();
            $table->enum('lead_status', ['New', 'Not Interested', 'Interested', 'Call Back', 'Call Back Future', 'Voice Mail', 'Pending', 'No Answer', 'Wrong Number'])->nullable();
            $table->string('lead_supplier')->nullable();
            $table->foreignId('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('leads');
    }
}
