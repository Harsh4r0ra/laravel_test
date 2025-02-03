// database/migrations/2024_01_30_000002_create_user_table.php
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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->foreignId('email_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('mobile_number');
            $table->string('user_name')->unique();
            $table->string('password');
            $table->foreignId('zone_id');
            $table->foreignId('visibility_group_id');
            $table->foreignId('userset_id');
            $table->foreignId('created_by');
            $table->foreignId('modified_by');
            $table->timestamp('created_at');
            $table->timestamp('modified_at');
            $table->boolean('is_active');
            $table->softDeletes();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};