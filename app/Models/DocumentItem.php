<?php

namespace App\Models;

use App\Enums\DiscountType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'document_id',
    'service_item_id',
    'name',
    'description',
    'quantity',
    'unit_price',
    'discount_type',
    'discount_value',
    'tax_rate',
    'subtotal',
    'discount_total',
    'tax_total',
    'line_total',
    'sort_order',
    'metadata',
])]
class DocumentItem extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'discount_type' => DiscountType::class,
            'tax_rate' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function serviceItem(): BelongsTo
    {
        return $this->belongsTo(ServiceItem::class);
    }
}
