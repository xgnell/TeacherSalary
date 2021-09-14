<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('salary_level');
            $table->double('salary_per_hour');
            $table->double('salary_overtime_per_hour');
            $table->unsignedInteger('updated_by');

            $table->primary('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->foreign('salary_level')->references('level')->on('salary_level');
            $table->foreign('updated_by')->references('id')->on('admin');
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
        Schema::dropIfExists('salary');
    }
}
