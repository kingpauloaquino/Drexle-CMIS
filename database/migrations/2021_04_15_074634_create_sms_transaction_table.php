<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_uid');
            $table->string('subject');
            $table->string('mobile', 20);
            $table->string('message', 160);
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = sent, 3 = failed
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
        Schema::dropIfExists('sms_transaction');
    }
}
