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
            $table->string('description');
            $table->string('variavel_rate_type')->nullable();
            $table->decimal('variavel_rate', 15, 2)->nullable();
            $table->decimal('flat_rate', 15, 2)->nullable();
            $table->timestamp('reward_at');

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
