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
        Schema::create('notificationsubscribe', function (Blueprint $table) {
            $table->id();
            $table->string('status',20);
            $table->timestamps();
            $table->text('public_key');
            $table->text('private_key');
            $table->text('auth_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificationsubscribe');
    }
};
