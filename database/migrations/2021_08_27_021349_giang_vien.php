<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiangVien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->boolean('gender');
            $table->string('address');
            $table->integer('phone');
            $table->string('image');
            $table->boolean('teaching_formality');
            $table->unsignedInteger('major_id');
            $table->unsignedInteger('salary_id');
            $table->boolean('status');
            $table->foreign('major_id')->references('id')->on('major');
            $table->foreign('salary_id')->references('id')->on('salary');
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
