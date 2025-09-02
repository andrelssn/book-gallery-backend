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
        Schema::create('repartitions', function (Blueprint $table) {
            $table
                ->id();
            $table
                ->unsignedBigInteger('id_user')
                ->nullable(false);
            $table
                ->string('repartition_name')
                ->nullable(false);
            $table
                ->decimal('repartition_value', 10, 2)
                ->nullable(false);

            // FK
            $table
                ->foreign('id_user')
                ->references('id')
                ->on('users')
                ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repartitions');
    }
};
