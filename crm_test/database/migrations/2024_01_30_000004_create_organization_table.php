<?php
// database/migrations/2024_01_30_000004_create_organization_table.php
class CreateOrganizationTable extends Migration
{
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
            $table->id('organization_id');
            $table->string('name', 50)->nullable(false);
            $table->decimal('annual_revenue', 10, 2)->nullable();
            $table->date('estd_date')->nullable();
            $table->string('legal_structure', 30)->nullable();
            $table->string('type_of_business', 30)->nullable();
            $table->string('occupation', 50)->nullable();
            $table->integer('employee_count')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('organization');
    }
}

// Additional related migrations follow similar pattern...