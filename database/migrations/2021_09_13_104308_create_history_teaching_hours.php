<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTeachingHours extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_teaching_hours', function (Blueprint $table) {
            $table->date('time');
            $table->unsignedInteger('teacher_id');

            $table->double('total_hours');
            $table->double('total_overtime_hours');
            
            $table->integer('status');
            $table->unsignedInteger('updated_by');

            $table->primary(['time', 'teacher_id']);
            $table->foreign('teacher_id')->references('id')->on('teacher');
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
        Schema::dropIfExists('history_teaching_hours');
    }
}
