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
        Schema::create('master_cars', function (Blueprint $table) {
         $table->uuid('id')->primary();
         $table->string('merek')->nullable();
         $table->string('model')->nullable();
         $table->string('platNumber')->nullable();
         $table->string('price')->nullable();
         $table->string('status')->nullable();
         $table->text('description')->nullable();
         $table->string('created_by')->nullable();
         $table->string('updated_by')->nullable();
         $table->timestamps();
         $table->softDeletes();

     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_cars');
    }
};
