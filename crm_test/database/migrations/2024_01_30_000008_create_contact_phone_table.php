// database/migrations/2024_01_30_000008_create_contact_phone_table.php
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
        Schema::create('contact_phone', function (Blueprint $table) {
            $table->id('contact_phone_id');
            $table->foreignId('contact_id')->constrained('contact', 'contact_id')->onDelete('cascade');
            $table->foreignId('phone_id')->constrained('phone', 'phone_id')->onDelete('cascade');
            $table->string('contact_phone_type', 16)
                ->nullable()
                ->default('Mobile')
                ->check('contact_phone_type in ("Mobile", "Landline")');
            $table->boolean('is_primary_phone')->default(false);
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
        Schema::dropIfExists('contact_phone');
    }
};