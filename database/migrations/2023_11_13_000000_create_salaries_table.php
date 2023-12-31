<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->integer('amount');

            $table->enum('type', ['monthly', 'weekly','daily']);

            $table->date('date')->nullable();

            $table->date('from')->nullable();
            $table->date('to')->nullable();



            $table->unsignedBigInteger('bank');
            $table->integer('status')->default(0);
            $table->string('IBAN');

            $table->text('detail')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank')->references('id')->on('banks')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
