<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherInsurance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_insurance', function (Blueprint $table) {
            $table->unsignedInteger('insurance_id');
            $table->unsignedInteger('teacher_id');

            $table->primary(['insurance_id', 'teacher_id']);
            $table->foreign('insurance_id')->references('id')->on('insurance');
            $table->foreign('teacher_id')->references('id')->on('teacher');
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
        Schema::dropIfExists('teacher_insurance');
    }
}
