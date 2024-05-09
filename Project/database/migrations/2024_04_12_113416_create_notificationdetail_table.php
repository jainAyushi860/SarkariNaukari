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
        Schema::create('notificationdetail', function (Blueprint $table) {
            $table->id();
            $table->string('title',20);
            $table->text('description',255);
            $table->string('image',255);
            $table->string('remark',255);
            $table->text('link',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificationdetail');
    }
};
