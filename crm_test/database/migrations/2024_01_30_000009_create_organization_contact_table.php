<?php

// 2024_01_30_000009_create_organization_contact_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('organization_contact', function (Blueprint $table) {
            $table->id('organization_contact_id');
            $table->foreignId('organization_id')->constrained('organization', 'organization_id')->onDelete('cascade');
            $table->foreignId('contact_id')->constrained('contact', 'contact_id')->onDelete('cascade');
            $table->boolean('is_primary_contact')->default(false);
            // Common columns
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable(false);
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('organization_contact');
    }
};