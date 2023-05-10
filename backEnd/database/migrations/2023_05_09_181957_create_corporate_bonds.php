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
        Schema::create('corporate_bonds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('wallet_id')->unsigned();
            $table->string('bonds');
            $table->integer('payment_type')->default(0)->description("0 Pós fixado, 1 Pré fixado");
            $table->string('variavel _rate_type')->nullable();
            $table->decimal('variable_rate')->nullable();
            $table->decimal('flat_rate')->nullable();

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
        Schema::dropIfExists('corporate_bonds');
    }
};