<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained()->cascadeOnDelete();
            $table->string('claimant')->nullable();
            $table->date('claim_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('funding_date')->nullable();
            $table->foreignId('status_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('insurance_company_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('adjuster_id')->nullable()->constrained()->nullOnDelete();
            $table->string('adjuster_phone')->nullable();
            $table->string('claim_handler')->nullable();
            $table->string('client')->nullable();
            $table->timestamps();

            $table->index('claim_date');
            $table->index('claimant');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
