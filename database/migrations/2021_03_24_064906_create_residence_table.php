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
            $table->string('firstname');
            $table->string('laststname');
            $table->string('gender');
            $table->string('age');
            $table->string('address');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('civil_status');
            $table->string('occupation');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
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
