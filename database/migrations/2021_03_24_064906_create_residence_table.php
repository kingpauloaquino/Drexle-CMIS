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
            $table->string('gender', 11);
            $table->integer('age');
            $table->text('address');
            $table->date('birthdate');
            $table->string('birthplace', 20);
            $table->string('civil_status', 10);
            $table->string('occupation', 100);
            $table->string('email')->unique();
            $table->string('mobile', 11)->unique();
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
