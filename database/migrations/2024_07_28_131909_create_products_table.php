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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name')
                ->comment('Название товара');

            $table->text('description')
                ->nullable()
                ->comment('Описание товара');

            $table->decimal('price', 10, 2)
                ->index()
                ->default(0)
                ->comment('Цена продукта');

            $table->timestamps();

            $table->index(['price', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
