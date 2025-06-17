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
        Schema::table('events_items', function (Blueprint $table) {
            $table->integer('condition')->default(0);
            $table->bigInteger('condition_quantity')->default(0);
            $table->text('notes')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events_items', function (Blueprint $table) {
            $table->dropColumn('condition');
            $table->dropColumn('condition_quantity');
            $table->dropColumn('notes');
            $table->dropColumn('image');
        });
    }
};
