<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentdatas', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("student_id");
            $table->string("leerlingnummer")->nullable();
            $table->string("voornaam")->nullable();
            $table->string("tussenvoegsel")->nullable();
            $table->string("achternaam")->nullable();
            $table->string("geboortedatum")->nullable();
            $table->string("straat")->nullable();
            $table->string("huisnummer")->nullable();
            $table->string("huisnummer_toevoeging")->nullable();
            $table->string("postcode")->nullable();
            $table->string("woonplaats")->nullable();
            $table->string("telefoon_1")->nullable();
            $table->string("telefoon_2")->nullable();
            $table->string("email")->nullable();
            $table->string("ouder_verzorger_1")->nullable();
            $table->string("ouder_verzorger_2")->nullable();
            $table->string("voogd")->nullable();
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
        Schema::dropIfExists('studentdatas');
    }
}
