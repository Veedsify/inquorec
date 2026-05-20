<?php

namespace App\Services\Documents;

use App\Enums\DocumentType;
use App\Models\Document;

class DocumentNumberGenerator
{
    public function generate(int $businessId, DocumentType $documentType, ?int $year = null): string
    {
        $year = $year ?? (int) now()->format('Y');
        $prefix = $this->prefixFor($documentType);

        $latestNumber = Document::query()
            ->where('business_id', $businessId)
            ->where('type', $documentType->value)
            ->where('document_number', 'like', sprintf('%s-%d-%%', $prefix, $year))
            ->max('document_number');

        $nextSequence = 1;

        if (is_string($latestNumber) && preg_match('/(\d{6})$/', $latestNumber, $matches) === 1) {
            $nextSequence = ((int) $matches[1]) + 1;
        }

        return sprintf('%s-%d-%06d', $prefix, $year, $nextSequence);
    }

    private function prefixFor(DocumentType $documentType): string
    {
        return match ($documentType) {
            DocumentType::Invoice => 'INV',
            DocumentType::Quotation => 'QUO',
            DocumentType::Receipt => 'RCT',
            DocumentType::Proforma => 'PRO',
            DocumentType::DeliveryNote => 'DEL',
            DocumentType::Statement => 'STM',
        };
    }
}
