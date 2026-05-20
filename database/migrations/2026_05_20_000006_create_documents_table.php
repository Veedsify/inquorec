<?php

use App\Enums\DocumentStatus;
use App\Enums\DocumentType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('business_id')->constrained()->cascadeOnDelete();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('bank_account_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('template_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default(DocumentType::Invoice->value);
            $table->string('status')->default(DocumentStatus::Draft->value);
            $table->string('document_number');
            $table->string('reference')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('currency', 3)->default('NGN');
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('tax_total')->default(0);
            $table->unsignedBigInteger('discount_total')->default(0);
            $table->unsignedBigInteger('grand_total')->default(0);
            $table->unsignedBigInteger('amount_paid')->default(0);
            $table->unsignedBigInteger('balance_due')->default(0);
            $table->text('notes')->nullable();
            $table->text('terms')->nullable();
            $table->text('footer')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            $table->index('business_id');
            $table->index('client_id');
            $table->index('type');
            $table->index('status');
            $table->index('document_number');
            $table->unique(['business_id', 'document_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
