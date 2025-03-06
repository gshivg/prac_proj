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
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->primary();
            $table->string('name', 50);
            $table->boolean('public')->default(false);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->unsignedBigInteger('role_id')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::table('roles')->insert([
            ['name' => 'Buyer', 'public' => true],
            ['name' => 'Delivery Agent', 'public' => true],
            ['name' => 'Warehouse Manager', 'public' => true],
            ['name' => 'Admin', 'public' => true],
        ]);

        DB::table('users')->insert([
            ['name' => 'Shivansh Gupta', 'email' => 'gshivg@icloud.com', 'role_id' => 4, 'password' => '$2y$12$YXMhE25AIsIhdUikEWq/geY0ThGffiUAyaFARycxhZwxYQjxQFlZO'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('roles');
    }
};
