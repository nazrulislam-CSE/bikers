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
        Schema::create('bike_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bike_registration_id')->constrained()->cascadeOnDelete();

            $table->enum('plan',['daily','weekly']);
            $table->decimal('fixed_amount',10,2)->default(50);

            // 🔽 Payment Info
            $table->enum('payment_method',['bkash','nagad','rocket','cash']);
            $table->string('payment_slip')->nullable();

            // 🔽 Due Engine
            $table->date('last_paid_date')->nullable();
            $table->date('next_due_date');

            $table->integer('due_days')->default(0);
            $table->decimal('due_amount',10,2)->default(0);

            $table->decimal('total_paid',10,2)->default(0);

            $table->enum('status',['active','blocked'])->default('active');
            $table->enum('approval_status',['pending','approved','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bike_payments');
    }
};
