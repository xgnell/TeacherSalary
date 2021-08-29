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
            $table->integer('month');
            $table->integer('year');
            $table->primary(array('teacher_id','month'));
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
