<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryKPI extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_kpi', function (Blueprint $table) {
            $table->date('time');
            $table->unsignedInteger('teacher_id');

            $table->unsignedInteger('criteria_id');
            $table->integer('point');

            $table->integer('status');
            $table->unsignedInteger('updated_by');

            $table->primary(['time','teacher_id', 'criteria_id']);
            $table->foreign('teacher_id')->references('id')->on('teacher');
            $table->foreign('criteria_id')->references('id')->on('kpi');
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
        Schema::dropIfExists('history_kpi');
    }
}
