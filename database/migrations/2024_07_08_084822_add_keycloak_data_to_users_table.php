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
        Schema::table('users', function (Blueprint $table) {
            $table->string('ref_id');
            $table->longText('kc_access_token')->nullable();
            $table->longText('kc_refresh_token')->nullable();
            $table->timestamp('kc_access_token_expiration')->nullable();
            $table->timestamp('kc_refresh_token_expiration')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ref_id');
            $table->dropColumn('kc_access_token');
            $table->dropColumn('kc_refresh_token');
            $table->dropColumn('kc_access_token_expiration');
            $table->dropColumn('kc_refresh_token_expiration');
        });
    }
};
