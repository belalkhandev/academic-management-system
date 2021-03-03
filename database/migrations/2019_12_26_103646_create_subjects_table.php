<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('academic_class_id');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('photo')->nullable();
            $table->integer('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();

            $table->foreign('academic_class_id')->references('id')->on('academic_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
