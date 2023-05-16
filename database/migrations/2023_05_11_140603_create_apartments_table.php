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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
            ->constrained()
            ->cascadeOnDelete();

            $table->string('title', 100);
            $table->text('description');
            $table->unsignedTinyInteger('rooms');
            $table->unsignedTinyInteger('beds');
            $table->unsignedTinyInteger('bathrooms');
            $table->unsignedSmallInteger('mq');
            $table->text('address');
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->float('price', 6,2 )->unsigned();
            $table->string('image', 255)->nullable();
            // slug unique, nullable solo per prova salvataggio
            $table->string('slug', 255)->nullable();
            $table->boolean('visibility')->default(1);
            
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
        Schema::dropIfExists('apartments');
    }
};