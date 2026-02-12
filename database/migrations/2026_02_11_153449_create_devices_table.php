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
    Schema::create('devices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained(); // Ce este? (Laptop)
        $table->foreignId('room_id')->constrained();     // Unde este? (Camera X)
        
        $table->string('brand'); // Ex: Dell
        $table->string('model'); // Ex: Latitude 5520
        $table->string('serial_number')->nullable(); // SN de la producător
        
        // Numărul de inventar generat automat (ex: DOLJ-NB-0001)
        $table->string('inventory_number')->unique()->nullable(); 
        
        // Statusul (Disponibil, Alocat, etc.)
        $table->enum('status', ['disponibil', 'alocat', 'service', 'retras'])->default('disponibil');
        
        // Cine îl folosește (numele angajatului)
        $table->string('allocated_user')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
