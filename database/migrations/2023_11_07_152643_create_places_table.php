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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->float('latitude', 8, 5);
            $table->float('longitude', 8, 5);
            $table->string('descripcion',255); 
            $table->integer('file_id');
            $table->integer('author_id');
            $table->unsignedBigInteger('visibility_id');
            $table->timestamps();
            // $table->foreign('visibility_id')->references('id')->on('visibilities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
