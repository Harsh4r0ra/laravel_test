<?php
// database/migrations/2024_01_30_000003_create_contact_table.php
class CreateContactTable extends Migration
{
    public function up()
    {
        Schema::create('contact', function (Blueprint $table) {
            $table->id('contact_id');
            $table->string('first_name', 16)->nullable(false);
            $table->string('last_name', 16)->nullable();
            $table->string('source', 32)->nullable();
            $table->string('occupation', 32)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 16)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('organization_id')->nullable()->constrained('organization', 'organization_id');
            $table->foreignId('company_id')->constrained('company', 'company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact');
    }
}

