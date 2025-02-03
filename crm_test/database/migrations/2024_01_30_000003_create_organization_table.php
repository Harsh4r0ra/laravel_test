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
        Schema::create('organization', function (Blueprint $table) {
            $table->id('organization_id');
            $table->string('name', 50)->nullable(false);
            $table->decimal('annual_revenue', 10, 2)->nullable();
            $table->date('estd_date')->nullable();
            $table->string('legal_structure', 30)->nullable();
            $table->string('type_of_business', 30)->nullable();
            $table->string('occupation', 50)->nullable();
            $table->integer('employee_count')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('organization');
    }
};