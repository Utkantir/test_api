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
        Schema::create('employees', function (Blueprint $table) {
              $table->id();
              $table->string('email');
              $table->string('name');
              $table->unsignedTinyInteger('age');
              $table->unsignedTinyInteger('work_experience');
              $table->string('photo')->nullable();
              $table->unsignedInteger('average_salary');
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
        Schema::dropIfExists('employees');
    }
};
