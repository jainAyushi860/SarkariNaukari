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
        Schema::create('userrole', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('password',100)->nullable();
            $table->string('token')->nullable();
            $table->string('status',20);
            $table->string('roles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userrole');
    }
};
