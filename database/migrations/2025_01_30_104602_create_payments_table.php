<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number')->unique();
            $table->foreignId('sale_id')->constrained('sales');
            $table->decimal('amount', 12, 2);
            $table->enum('payment_method', ['cash', 'credit']);
            $table->enum('status', ['pending', 'paid', 'failed']);
            $table->integer('term_length')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_installments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments');
            $table->decimal('installment_amount', 12, 2);
            $table->integer('installment_number');
            $table->date('due_date');
            $table->enum('status', ['pending', 'paid', 'overdue']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_installments');
        Schema::dropIfExists('payments');
    }
};