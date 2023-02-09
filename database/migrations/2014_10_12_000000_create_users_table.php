<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rules\Unique;

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
            $table->string('personnel_code')->nullable()->Unique();
            $table->string('title')->nullable();
            $table->string('email')->unique();
            $table->string('about')->nullable();
            $table->string('password')->nullable();
            $table->string('fullname')->nullable();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('address')->nullable();
            $table->integer('status')->default(0);
            $table->date('recruitment_date')->nullable();
            $table->string('img_url')->nullable();
            $table->integer('gender')->default(0);
            $table->integer('level')->default(0);
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
