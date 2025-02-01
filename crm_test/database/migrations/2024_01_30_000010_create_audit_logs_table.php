<?php

// 2024_01_30_000010_create_audit_logs_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id('audit_id');
            $table->string('user_type')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('event');
            $table->string('auditable_type');
            $table->unsignedBigInteger('auditable_id');
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->text('url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent', 1023)->nullable();
            $table->string('tags')->nullable();
            // Common columns
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_logs');
    }
};

// 2024_01_30_000011_create_api_logs_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->string('method');
            $table->text('url');
            $table->text('payload')->nullable();
            $table->integer('response_code')->nullable();
            $table->text('response')->nullable();
            $table->decimal('duration', 8, 4)->nullable(); // Duration in seconds
            $table->ipAddress('ip_address');
            $table->string('user_agent', 1023)->nullable();
            // Common columns
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
};