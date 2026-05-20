<?php

use App\Enums\DocumentType;
use App\Models\Document;
use App\Services\Documents\DocumentNumberGenerator;

it('generates first document number for business type and year', function (): void {
    $generator = new DocumentNumberGenerator();

    $number = $generator->generate(12, DocumentType::Invoice, 2026);

    expect($number)->toBe('INV-2026-000001');
});

it('increments sequence for same business type and year', function (): void {
    Document::query()->create([
        'business_id' => 77,
        'type' => DocumentType::Invoice,
        'status' => 'draft',
        'document_number' => 'INV-2026-000009',
    ]);

    $generator = new DocumentNumberGenerator();
    $number = $generator->generate(77, DocumentType::Invoice, 2026);

    expect($number)->toBe('INV-2026-000010');
});

it('scopes sequence by business and document type', function (): void {
    Document::query()->create([
        'business_id' => 1,
        'type' => DocumentType::Invoice,
        'status' => 'draft',
        'document_number' => 'INV-2026-000020',
    ]);

    Document::query()->create([
        'business_id' => 2,
        'type' => DocumentType::Invoice,
        'status' => 'draft',
        'document_number' => 'INV-2026-000010',
    ]);

    Document::query()->create([
        'business_id' => 1,
        'type' => DocumentType::Quotation,
        'status' => 'draft',
        'document_number' => 'QUO-2026-000015',
    ]);

    $generator = new DocumentNumberGenerator();

    expect($generator->generate(1, DocumentType::Invoice, 2026))->toBe('INV-2026-000021')
        ->and($generator->generate(2, DocumentType::Invoice, 2026))->toBe('INV-2026-000011')
        ->and($generator->generate(1, DocumentType::Quotation, 2026))->toBe('QUO-2026-000016');
});
