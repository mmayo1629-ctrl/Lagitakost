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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('price');
            $table->decimal('payment_amount', 15, 2)->nullable()->after('payment_method');
            $table->date('payment_date')->nullable()->after('payment_amount');
            $table->string('payment_proof')->nullable()->after('payment_date');
            $table->text('payment_notes')->nullable()->after('payment_proof');
            $table->enum('payment_status', ['pending', 'pending_verification', 'verified', 'rejected'])->nullable()->after('payment_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_method',
                'payment_amount',
                'payment_date',
                'payment_proof',
                'payment_notes',
                'payment_status'
            ]);
        });
    }
};
