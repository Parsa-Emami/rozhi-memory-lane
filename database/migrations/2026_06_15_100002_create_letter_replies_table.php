<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('letter_replies', function (Blueprint $table) {
            $table->id();
            $table->string('nickname')->nullable();
            $table->string('mood')->nullable();
            $table->text('answer');
            $table->string('ip_hash')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('letter_replies');
    }
};
