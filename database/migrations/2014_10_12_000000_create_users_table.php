<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('password');

            $table->integer('salary');
            $table->unsignedBigInteger('bank');
            $table->string('IBAN');
            $table->enum('part_time',['daily','period','weekly'])->nullable();
            $table->integer('vacation_balance')->default(0);
            

            $table->enum('type', ['full-time', 'part-time']);

            




            $table->string('gender')->nullable();
            $table->string('email')->unique()->nullable();
            
            $table->integer('status')->default(0);

            $table->integer('ID_no');
            $table->date('unemployment_date')->nullable();
            $table->date('birthday');
            $table->string('phone');



            $table->string('address')->nullable();

           



            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('company_id');
            $table->string('position');

            $table->string('image')->nullable();
            $table->string('ID_image')->nullable();
            $table->string('license_image')->nullable();

            $table->string('otp')->nullable();


            $table->date('start_date');
     
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->unique();
            $table->timestamps();
           


            
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}
