<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorySalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_salary', function (Blueprint $table) {
            $table->date('time'); 
            $table->unsignedInteger('teacher_id');

            $table->double('basic_salary');
            $table->double('salary_per_hour');
            $table->double('salary_overtime_per_hour');
            $table->double('total_insurance');  // Tổng % của tất cả loại bảo hiểm
            $table->double('total_salary');

            $table->integer('status');

            $table->primary(['teacher_id','time']);
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
        Schema::dropIfExists('history_salary');
    }
}
