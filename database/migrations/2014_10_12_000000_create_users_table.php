<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id');
            $table->foreignId('qr_id');
            $table->string('name');
            $table->string('nis')->unique();
            $table->string('email')->unique();
            $table->string('gender');
            $table->date('lahir_ayah')->nullable();
            $table->date('lahir_ibu')->nullable();
            $table->string('password');
            $table->tinyInteger('role_id')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
