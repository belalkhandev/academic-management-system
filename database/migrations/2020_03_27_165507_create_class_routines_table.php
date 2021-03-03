<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_routines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('day_id')->nullable();
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->unsignedBigInteger('academic_class_id');
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('day')->nullable();
            $table->time('start_time');
            $table->time('end_time');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('day_id')->references('id')->on('days')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('academic_class_id')->references('id')->on('academic_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_routines');
    }
}
