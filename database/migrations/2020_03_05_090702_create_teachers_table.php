<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('teacher_id');
            $table->string('id_type')->default('system-define')->comment('system-define, user-define');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->string('email');
            $table->string('phone');
            $table->string('emergency_phone')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('marital_status');
            $table->string('present_address');
            $table->string('permanent_address');
            $table->string('qulification');
            $table->text('details')->nullable();
            $table->string('photo')->nullable();
            $table->string('resume')->nullable();
            $table->integer('status')->default(1)->comment('0=inactive,1=active');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
