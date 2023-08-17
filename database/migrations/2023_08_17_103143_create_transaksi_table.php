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
        Schema::create('t_car_loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('loanDate')->nullable();
            $table->string('returnPlanDate')->nullable();
            $table->string('status')->nullable();
            $table->uuid('master_car_id')->nullable();
            $table->uuid('user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('master_car_id')->references('id')->on('master_cars')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });

         Schema::create('t_car_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('returnRealDate')->nullable();
            $table->string('totalDay')->nullable();
            $table->string('totalPrice')->nullable();
            $table->uuid('t_car_loan_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('t_car_loan_id')->references('id')->on('t_car_loans')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_car_returns');
        Schema::dropIfExists('t_car_loans');
    }
};
