<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residence', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->text('address1');
            $table->text('address2');
            $table->integer('age');
            $table->integer('year_stay')->nullable();
            $table->integer('household')->nullable();
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('nationality');
            $table->string('blood')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('mobile', 11)->unique();
            $table->string('work')->nullable();
            $table->string('skill')->nullable();
            $table->date('schedule')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('residence');
    }
}
