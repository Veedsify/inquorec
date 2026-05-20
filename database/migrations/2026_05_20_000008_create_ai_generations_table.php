<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_generations', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('document_id')->nullable()->constrained()->nullOnDelete();
            $table->string('feature');
            $table->text('input_text');
            $table->json('output_json')->nullable();
            $table->string('model')->nullable();
            $table->string('status')->default('pending');
            $table->text('error_message')->nullable();
            $table->unsignedInteger('tokens_input')->nullable();
            $table->unsignedInteger('tokens_output')->nullable();
            $table->timestamps();

            $table->index(['business_id', 'status']);
            $table->index('document_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_generations');
    }
};
