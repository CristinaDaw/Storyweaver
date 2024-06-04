<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('conversation_summary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('summary',5000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_summary');
    }
};
