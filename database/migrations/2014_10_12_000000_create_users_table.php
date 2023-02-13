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
            $table->bigInteger('position_id')->unsigned()->nullable()->references('id')->on('positions')->onDelete('set null');
            $table->bigInteger('department_id')->unsigned()->nullable()->references('id')->on('departments')->onDelete('set null');
            $table->string('personnel_code')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->nullable();
            $table->date('recruitment_date')->nullable();
            $table->string('img_url')->nullable();
            $table->integer('level')->nullable();
            $table->rememberToken();
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
