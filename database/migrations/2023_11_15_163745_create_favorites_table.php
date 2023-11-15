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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('place_id');
            $table->foreign('place_id')->references('id')->on('places')
                    ->onUpdate('cascade')->onDelete('cascade');
            // Eloquent does not support composite PK :-(
            // $table->primary(['column1', 'column2']);
            $table->unique(['user_id', 'place_id']);
        });
        // Eloquent compatibility workaround :-)
        // Schema::table('favs', function (Blueprint $table) {
        //     $table->id()->first();
        //     $table->unique(['user_id', 'places_id']);
        // });
     
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
