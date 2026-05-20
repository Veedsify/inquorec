<?php

namespace Database\Factories;

use App\Enums\DocumentStatus;
use App\Enums\DocumentType;
use App\Models\Business;
use App\Models\Document;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Document>
 */
class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'business_id' => Business::factory(),
            'type' => fake()->randomElement(DocumentType::cases()),
            'status' => DocumentStatus::Draft,
            'document_number' => 'INV-'.now()->format('Y').'-000001',
            'currency' => 'NGN',
            'subtotal' => 0,
            'tax_total' => 0,
            'discount_total' => 0,
            'grand_total' => 0,
            'amount_paid' => 0,
            'balance_due' => 0,
        ];
    }
}
