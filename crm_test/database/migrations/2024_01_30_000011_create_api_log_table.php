<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('api_log', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->text('url');
            $table->text('payload')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('response_code')->nullable();
            $table->text('response')->nullable();
            $table->float('duration')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('company_id')->on('company');
            $table->index(['url', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_log');
    }
};