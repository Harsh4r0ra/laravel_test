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
        Schema::create('contact', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('first_name', 16)->nullable(false);
            $table->string('last_name', 16)->nullable();
            $table->string('source', 32)->nullable();
            $table->string('occupation', 32)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 16)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained('organization', 'organization_id');
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};