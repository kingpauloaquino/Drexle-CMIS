<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidenceTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('residence_transaction', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->bigInteger('residence_uid');
            $table->json('details');
            $table->date('date_issued');
            $table->tinyInteger('status')->default(0); // 0 pending, 1 released, 2 hold, 3 void
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
        Schema::dropIfExists('residence_transaction');
    }
}
