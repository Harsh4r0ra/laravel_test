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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->string('email_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->timestamp('last_password_reset_date')->nullable();
            $table->string('mobile_number')->unique();
            $table->string('user_name');
            $table->string('password');
            $table->string('user_profile_photo')->nullable();
            $table->integer('zone_id');
            $table->integer('visibility_group_id');
            $table->integer('userset_id');
            $table->timestamp('dob')->nullable();
            $table->text('security_question')->nullable();
            $table->text('security_answer')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_account_expired')->default(false);
            $table->boolean('is_account_locked')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_credentials_expired')->default(false);
            $table->integer('created_by');
            $table->integer('modified_by');
            $table->timestamps(); // This will add both created_at and updated_at
            $table->timestamp('modified_at')->nullable();
            $table->softDeletes(); // This adds deleted_at
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};