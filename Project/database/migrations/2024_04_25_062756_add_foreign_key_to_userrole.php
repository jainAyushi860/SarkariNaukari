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
        Schema::table('userrole', function (Blueprint $table) {
                       // Add a new column for the foreign key
                       $table->unsignedBigInteger('roles')->nullable();
            
                       // Define the foreign key constraint
                       $table->foreign('roles')->references('id')->on('addrole')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('userrole', function (Blueprint $table) {
                // Drop the foreign key column if needed
                $table->dropForeign(['roles']);
            
                // Drop the column
                $table->dropColumn('roles');
        });
    }
};
