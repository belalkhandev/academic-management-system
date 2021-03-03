<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('student_id');
            $table->string('id_type')->default('system-define')->comment('system-define, user-define');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('father_name');
            $table->string('mother_name');            
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('birthdate');
            $table->string('birth_id')->nullable();
            $table->string('category')->comment('general, obc, special, physically challenge')->nullable();
            $table->string('religion');
            $table->string('caste')->nullable();
            $table->string('blood_group')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('father_photo')->nullable();
            $table->string('mother_photo')->nullable();
            $table->unsignedBigInteger('guardian_id');
            $table->string('relation', 50)->comment('relation with guardian');
            $table->integer('status')->default(1)->comment('1=active, 0=inactive');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('guardian_id')->references('id')->on('guardians')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
