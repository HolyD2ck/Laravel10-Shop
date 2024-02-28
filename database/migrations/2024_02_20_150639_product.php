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
            $table->string('Категория');
            $table->string('Тип');
            $table->string('Название');
            $table->string('Производитель');
            $table->decimal('Цена', 8, 2);
            $table->text('Описание');
            $table->string('Фото');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('Статус');
            $table->decimal('Конечная_Цена',8,2);
            $table->string('Место_Доставки');
            $table->string('Метод_Оплаты');
            $table->timestamps();
        });
        Schema::create('taskmasters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('Название');
            $table->date('Дата_Основания');
            $table->string('Директор');
            $table->string('Страна');
            $table->string('Гост');
            $table->string('Почта');
            $table->string('Фото');
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->integer('Количество');
            $table->decimal('Цена',8,2);
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('products');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
    
};
