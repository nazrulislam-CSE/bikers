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
        Schema::create('bike_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('name');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->string('photo')->nullable();

            $table->string('bike_name');
            $table->string('registration_no')->unique();
            $table->string('bike_photo')->nullable();

            $table->decimal('registration_fee',10,2)->default(0);

            $table->string('payment_method');
            $table->string('payment_slip')->nullable();
            $table->string('password')->nullable();

            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bike_registrations');
    }
};
