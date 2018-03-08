<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naam');
            $table->integer('coach_id');
            $table->integer('status_id')->default('1');
            $table->integer('reason_id')->nullable();
            $table->integer('color_id')->nullable();
            $table->boolean('deleted')->nullable()->default('0');
            $table->softDeletes();
            $table->integer('deleted_by')->nullable();
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
        Schema::dropIfExists('students');
    }
}
