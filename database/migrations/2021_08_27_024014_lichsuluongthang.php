<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lichsuluongthang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_salary', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id');
            $table->integer('month'); 
            $table->Double('total_salary');
            $table->Double('total_teaching_hours');
            $table->Double('total_ot_hours');
            $table->Double('total_kpi');
            $table->unsignedInteger('bhxh');
            $table->primary(array('teacher_id','month'));
           $table->foreign('teacher_id')->references('id')->on('teacher');

          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
