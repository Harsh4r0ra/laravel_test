<?php

// 2024_01_30_000007_create_contact_email_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('contact_email', function (Blueprint $table) {
            $table->id('contact_email_id');
            $table->foreignId('contact_id')->constrained('contact', 'contact_id')->onDelete('cascade');
            $table->foreignId('email_id')->constrained('email', 'email_id')->onDelete('cascade');
            $table->string('contact_email_type', 16)->nullable();
            $table->boolean('is_primary_email')->default(false);
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
        Schema::dropIfExists('contact_email');
    }
};
