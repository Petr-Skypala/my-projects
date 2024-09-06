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
        Schema::create('daytimes', function (Blueprint $table) {
            $table->id();
            $table->enum('day', ['Mon', 'Tue', 'Wed', 'Thu', 'Fri']);
            $table->time('from', precision: 0);
            $table->time('to', precision: 0);
            $table->integer('day_hours');
            $table->foreignId('carer_id')->constrained('carers')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daytimes');
    }
};
