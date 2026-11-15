<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barangays', function (Blueprint $table) {
            $table->string('name')->nullable()->unique();
        });

        Schema::table('crimes', function (Blueprint $table) {
            $table->foreignId('barangay_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->nullable()->index();
            $table->text('description')->nullable();
            $table->date('date')->nullable()->index();
            $table->string('risk_level')->default('monitored')->index();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('crimes', function (Blueprint $table) {
            $table->dropForeign(['barangay_id']);
            $table->dropIndex(['type']);
            $table->dropIndex(['date']);
            $table->dropIndex(['risk_level']);
            $table->dropColumn([
                'barangay_id',
                'type',
                'description',
                'date',
                'risk_level',
                'latitude',
                'longitude',
            ]);
        });

        Schema::table('barangays', function (Blueprint $table) {
            $table->dropUnique(['name']);
            $table->dropColumn('name');
        });
    }
};
