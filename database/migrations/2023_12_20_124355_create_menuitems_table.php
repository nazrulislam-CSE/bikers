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
        Schema::create('menuitems', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->integer('menu_id')->nullable();
            $table->integer('page_id')->nullable();
            $table->string('title')->nullable();
            $table->string('url')->nullable();
            $table->string('menu_type', '10')->nullable()->comment('Page,Custom Link');
            $table->string('sourch')->nullable();
            $table->string('location')->nullable();
            $table->unsignedTinyInteger('position')->default(1)->comment('Drag & Drop Position Updown')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1=>Publish, 0=>UnPublish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menuitems');
    }
};
