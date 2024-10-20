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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); //Анонс UF_ZAGOLOVOK
            $table->string('name'); //
            $table->string('slug'); //code
            $table->foreignId('parent_id')->nullable(); //subcategory
            $table->string('image_path'); //path to img for sub or category
            $table->longText('description')->nullable(); //infoblock
            $table->longText('info')->nullable(); // section (UF_DESCRIPTION)
            $table->string('keywords')->nullable(); //UF_KEYWORDS
            $table->string('announcement')->nullable(); //Анонс UF_ANOUNCE
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
