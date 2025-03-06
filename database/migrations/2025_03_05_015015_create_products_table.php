<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('name');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedMediumInteger('best_before_in_months');
            $table->foreignId('category_id')->constrained(table: 'categories');
            $table->boolean('available')->default(true);
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Medical Products'],
        ]);

        DB::table('products')->insert([
            ['name' => 'IV Fluids', 'price' => 10.4, 'best_before_in_months' => 6, 'category_id' => 1],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
