<?php
// database/migrations/2024_01_30_000002_create_user_table.php
class CreateUserTable extends Migration
{
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable(true);
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_account_expired')->default(false);
            $table->boolean('is_account_locked')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_credentials_expired')->default(false);
            $table->string('email_id', 255)->unique();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->timestamp('last_password_reset_date')->nullable();
            $table->string('mobile_number', 255)->unique();
            $table->string('user_name', 255);
            $table->string('password', 255);
            $table->string('user_profile_photo', 255)->nullable();
            $table->integer('zone_id')->nullable(false);
            $table->integer('visibility_group_id')->nullable(false);
            $table->integer('userset_id')->nullable(false);
            $table->timestamp('dob')->nullable();
            $table->text('security_question')->nullable();
            $table->text('security_answer')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user');
    }
}

