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
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('img_avatar',500)->nullable();
            $table->string('name',25);
            $table->string('class',30);
            $table->string('race',30);
            $table->string('faction',50);
            $table->text('background',360);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
};
