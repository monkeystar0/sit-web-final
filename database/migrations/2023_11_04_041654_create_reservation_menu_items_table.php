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
        Schema::create('reservation_menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservation_items')->onDelete('cascade');
            $table->string('name');
            $table->string('menu_id');
            $table->integer('qty');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_menu_items');
    }
};
