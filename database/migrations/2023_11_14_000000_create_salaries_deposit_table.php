<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries_deposit', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('salary_id');

            $table->integer('amount');

            $table->unsignedBigInteger('deposit_by');
            $table->date('date');
            $table->time('time');

            $table->string('transaction')->nullable();
            $table->text('detail')->nullable();

            $table->timestamps();

            $table->foreign('deposit_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries_deposit');
    }
}
