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
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('sales_representative_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->nullable();
            $table->date('date_of_registration')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('organization_zip')->nullable();
            $table->string('organization_state')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_zip')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('contact_full_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
