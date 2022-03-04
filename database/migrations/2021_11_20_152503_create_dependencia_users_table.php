<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDependenciaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dependencia_users', function (Blueprint $table) {
            $table->primary(['user_id', 'dependencia_id']);
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dependencia_id')->constrained();
            $table->boolean('principal')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dependencia_users');
    }
}
