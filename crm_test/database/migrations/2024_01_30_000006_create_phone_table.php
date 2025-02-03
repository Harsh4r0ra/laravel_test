<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('phone', function (Blueprint $table) {
            $table->id();
            $table->string('country_code');
            $table->string('std_code');
            $table->string('phone_no');
            $table->foreignId('company_id');
            $table->foreignId('created_by');
            $table->foreignId('modified_by')->nullable(); // Allow modified_by to be nullable
            $table->timestamps();
            $table->timestamp('modified_at')->nullable(); // Fix: Add modified_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone');
    }
};
