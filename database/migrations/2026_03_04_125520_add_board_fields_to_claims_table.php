<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->string('claim_number')->nullable()->after('claimant');
            $table->text('description')->nullable()->after('claim_number');
            $table->string('priority')->nullable()->after('status_id');
            $table->text('address')->nullable()->after('adjuster_phone');
            $table->decimal('original_cost_value', 12, 2)->nullable()->after('settlement_amount');
            $table->decimal('supplement_increase', 12, 2)->nullable()->after('original_cost_value');
        });

        Schema::create('claim_follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->cascadeOnDelete();
            $table->date('follow_up_date');
            $table->text('note')->nullable();
            $table->timestamps();
            $table->index('follow_up_date');
        });

        Schema::create('claim_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('claim_id')->constrained()->cascadeOnDelete();
            $table->string('author');
            $table->text('text');
            $table->timestamp('commented_at')->useCurrent();
            $table->timestamps();
            $table->index('claim_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('claim_notes');
        Schema::dropIfExists('claim_follow_ups');

        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn([
                'claim_number',
                'description',
                'priority',
                'address',
                'original_cost_value',
                'supplement_increase',
            ]);
        });
    }
};
