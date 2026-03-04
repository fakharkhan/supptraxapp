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
        Schema::table('organization_users', function (Blueprint $table) {
            $table->string('type')->default('External User')->after('user_email');
            $table->boolean('is_chaser')->default(false)->after('type');
            $table->boolean('is_closer')->default(false)->after('is_chaser');
            $table->unsignedInteger('claims_count')->default(0)->after('is_closer');
        });
    }

    public function down(): void
    {
        Schema::table('organization_users', function (Blueprint $table) {
            $table->dropColumn(['type', 'is_chaser', 'is_closer', 'claims_count']);
        });
    }
};
