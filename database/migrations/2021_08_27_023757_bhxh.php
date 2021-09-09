<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bhxh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bhxh', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id');
            $table->integer('total_value');
            $table->date('time');
            $table->primary(array('teacher_id','time'));
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
        //
    }
}
