<?php

use App\Enums\DocumentType;
use App\Models\Document;
use App\Services\Documents\DocumentNumberGenerator;

uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class);

it('generates first document number for business type and year', function (): void {
    $businessId = App\Models\Business::factory()->create()->id;
    $generator = new DocumentNumberGenerator();

    $number = $generator->generate($businessId, DocumentType::Invoice, 2026);

    expect($number)->toBe('INV-2026-000001');
});

it('increments sequence for same business type and year', function (): void {
    $businessId = App\Models\Business::factory()->create()->id;

    Document::factory()->create([
        'business_id' => $businessId,
        'type' => DocumentType::Invoice,
        'document_number' => 'INV-2026-000009',
    ]);

    $generator = new DocumentNumberGenerator();
    $number = $generator->generate($businessId, DocumentType::Invoice, 2026);

    expect($number)->toBe('INV-2026-000010');
});

it('scopes sequence by business and document type', function (): void {
    $firstBusinessId = App\Models\Business::factory()->create()->id;
    $secondBusinessId = App\Models\Business::factory()->create()->id;

    Document::factory()->create([
        'business_id' => $firstBusinessId,
        'type' => DocumentType::Invoice,
        'document_number' => 'INV-2026-000020',
    ]);

    Document::factory()->create([
        'business_id' => $secondBusinessId,
        'type' => DocumentType::Invoice,
        'document_number' => 'INV-2026-000010',
    ]);

    Document::factory()->create([
        'business_id' => $firstBusinessId,
        'type' => DocumentType::Quotation,
        'document_number' => 'QUO-2026-000015',
    ]);

    $generator = new DocumentNumberGenerator();

    expect($generator->generate($firstBusinessId, DocumentType::Invoice, 2026))->toBe('INV-2026-000021')
        ->and($generator->generate($secondBusinessId, DocumentType::Invoice, 2026))->toBe('INV-2026-000011')
        ->and($generator->generate($firstBusinessId, DocumentType::Quotation, 2026))->toBe('QUO-2026-000016');
});
