<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('salary_deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("salary_id");
            $table->unsignedBigInteger("deposit_by");
            $table->string("name",255);
            $table->unsignedSmallInteger("salary");
            $table->date("date");
            $table->string("bank",255);
            $table->string("company",255);
            $table->date("month");
            $table->string("account_number",30);
            $table->string("amount_written",300);
            $table->json("signatures");
            $table->timestamps();
            $table->foreign("salary_id")->references("id")->on("monthly_payrolls")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("deposit_by")->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_deposits');
    }
};
