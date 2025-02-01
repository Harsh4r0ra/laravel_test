<?php

// 2024_01_30_000006_create_phone_table.php
return new class extends Migration
{
    public function up()
    {
        Schema::create('phone', function (Blueprint $table) {
            $table->id('phone_id');
            $table->string('country_code', 4)->nullable();
            $table->string('std_code', 5)->nullable();
            $table->string('phone_no', 10)->nullable(false);
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
        Schema::dropIfExists('phone');
    }
};