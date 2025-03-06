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
        Schema::create('order_status', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('name', 50);
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'users', column: 'id', indexName: 'order_user_id')->cascadeOnUpdate();
            $table->decimal('total_amount', 10, 2);
            $table->foreignId('order_status_id')->constrained(table: 'order_status')->defult(1);

            $table->timestamps();
        });

        DB::table('order_status')->insert([
            ['name' => 'queued'],
            ['name' => 'processing'],
            ['name' => 'waiting_for_transit'],
            ['name' => 'transit'],
            ['name' => 'delivered'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_status');
    }
};
