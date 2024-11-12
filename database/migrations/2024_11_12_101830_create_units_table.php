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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('business_name');  // Razón social
            $table->string('tax_id');         // CIF
            $table->string('address');
            $table->string('phone');
            $table->string('photo_path')->nullable();  // Ruta a la imagen
            $table->string('status')->default('active');
            $table->json('zones');            // Almacena las zonas como un array en JSON
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
