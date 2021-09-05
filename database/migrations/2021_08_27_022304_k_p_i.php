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
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('total_value')->nullable()->default(0);
            $table->unsignedInteger('month');
            $table->primary(array('month','teacher_id','total_value'));
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
