<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trajet_id')->constrained()->onDelete('restrict');
            $table->foreignId('bus_id')->nullable()->constrained()->onDelete('set null');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->decimal('amount_paid', 10, 2);
            $table->string('payment_id')->nullable(); // Stripe/PayPal payment ID
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed']);
            $table->string('transaction_reference')->unique(); // For tracking
            $table->date('reservation_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}