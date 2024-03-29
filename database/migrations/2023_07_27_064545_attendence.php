<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendence', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->time('check_in');
            $table->time('check_out')->null;
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendence');
    }
};
