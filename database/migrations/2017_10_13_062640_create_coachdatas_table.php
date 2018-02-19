<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoachdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coachdatas', function(Blueprint $table){
            $table->increments('id');
            $table->integer('coach_id');
            $table->string('voornaam')->nullable();
            $table->string('tussenvoegsel')->nullable();
            $table->string('achternaam')->nullable();
            $table->string('email')->nullable();
            $table->string('telefoon')->nullable();
            $table->string('mobiel')->nullable();
            $table->string('straat')->nullable();
            $table->string('huisnummer')->nullable();
            $table->string('postcode')->nullable();
            $table->boolean('deleted')->nullable();
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
        Schema::dropIfExists('coachdatas');
    }
}
