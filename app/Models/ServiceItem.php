<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'business_id',
    'name',
    'description',
    'unit_price',
    'currency',
    'default_tax_rate',
    'category',
    'is_active',
])]
class ServiceItem extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'default_tax_rate' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function documentItems(): HasMany
    {
        return $this->hasMany(DocumentItem::class);
    }
}
