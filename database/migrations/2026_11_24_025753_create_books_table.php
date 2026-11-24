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
        Schema::create('books', function (Blueprint $table) {
            $table->id();

        // Associate each book with its administrator
        $table->foreignId('user_id')
              ->constrained()
              ->cascadeOnDelete();

        $table->string('title');
        $table->string('author');
        $table->string('category');
        $table->decimal('unit_price', 10, 2);
        $table->text('description');
        $table->string('availability_status');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
