<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('msgs', function (Blueprint $table) {
            $table->boolean('is_group')->default(false)->after('message');
        });
    }

    public function down(): void
    {
        Schema::table('msgs', function (Blueprint $table) {
            $table->dropColumn('is_group');
        });
    }
};
