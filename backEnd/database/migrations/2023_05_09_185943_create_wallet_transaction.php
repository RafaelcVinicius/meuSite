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
        Schema::create('wallet_transaction', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wallet_id')->unsigned();
            $table->char('operation', 1)->default(1)->description("0 sell , 1 buy");
            $table->decimal('amount', 15, 8);
            $table->decimal('unit_price', 15, 4);
            $table->timestamp('acquisition_at');
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('wallet')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transaction');
    }
};
