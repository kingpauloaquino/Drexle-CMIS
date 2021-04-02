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
            $table->string('middlename');
            $table->string('laststname');
            $table->text('address');
            $table->integer('year_stay');
            $table->integer('household');
            $table->date('birthdate');
            $table->string('birthplace');
            $table->string('gender');
            $table->string('civil_status');
            $table->string('nationality');
            $table->string('blood');
            $table->string('email')->unique();
            $table->string('mobile', 11)->unique();
            $table->string('work');
            $table->string('skill');
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
