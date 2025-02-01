<?php
// database/migrations/2024_01_30_000001_create_company_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->id('company_id');
            $table->integer('created_by')->nullable(false);
            $table->timestamp('created_at')->nullable(false);
            $table->integer('modified_by')->nullable(false);
            $table->timestamp('modified_at')->nullable(false);
            $table->boolean('is_deleted')->default(false);
            $table->string('company_name', 255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('company');
    }
}

