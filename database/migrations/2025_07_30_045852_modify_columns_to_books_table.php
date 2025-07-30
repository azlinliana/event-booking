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
        Schema::table('books', function (Blueprint $table) {
            // Drop old columns
            $table->dropForeign(['event_id']);
            $table->dropColumn(['event_id', 'number_ticket', 'total_price']);

            // Add new foreign id
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Drop new foreign id & columns
            $table->dropForeign(['user_id', 'ticket_id']);
            $table->dropColumn(['user_id', 'ticket_id']);

            // Restore old columns
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->integer('number_ticket');
            $table->decimal('total_price', 8, 2);
        });
    }
};
