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
        Schema::create('orders', function (Blueprint $table) {
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');
            $table->id();
            $table->string('ur');
            $table->unsignedBigInteger('inn');
            $table->unsignedBigInteger('ogrn');
            $table->string('uradr');
            $table->string('bank');
            $table->unsignedBigInteger('bik');
            $table->unsignedBigInteger('chet');
            $table->boolean('need_delivery')->nullable();
            $table->string('delivery')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('comment')->nullable();
            $table->boolean('need_call')->nullable();
            $table->json('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
