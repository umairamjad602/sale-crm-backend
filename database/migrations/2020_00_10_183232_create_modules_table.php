<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nickname', 100);
            $table->string('namespace');
            $table->string('default_permissions', 300);
            $table->enum('type', ['Core', 'Other']);
            $table->enum('status', ['Active', 'Inactive']);
            $table->boolean('permission_builder_visibility')->default(false);
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
