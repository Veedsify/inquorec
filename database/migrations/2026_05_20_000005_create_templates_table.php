<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('templates', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('business_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('type')->nullable();
            $table->string('preview_image_path')->nullable();
            $table->json('config')->nullable();
            $table->boolean('is_system')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['business_id', 'is_active']);
            $table->unique(['business_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('templates');
    }
};
