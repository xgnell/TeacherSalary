<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KPI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kpi', function (Blueprint $table) {
            $table->unsignedInteger('month');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('criteria_id');
            $table->primary(array('month','teacher_id','criteria_id'));
           $table->foreign('teacher_id')->references('id')->on('teacher');
           $table->foreign('criteria_id')->references('id')->on('criteria');
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
