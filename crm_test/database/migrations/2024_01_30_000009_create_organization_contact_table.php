// database/migrations/2024_01_30_000009_create_organization_contact_table.php
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
        Schema::create('organization_contact', function (Blueprint $table) {
            $table->id('organization_contact_id');
            $table->foreignId('organization_id')->constrained('organization', 'organization_id')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contact', 'contact_id')->onDelete('cascade');
            $table->boolean('is_primary_contact')->default(false);
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable(false);
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_contact');
    }
};