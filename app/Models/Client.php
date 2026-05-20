<?php

namespace App\Models;

use App\Enums\ClientType;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'business_id',
    'type',
    'name',
    'company_name',
    'email',
    'phone',
    'address_line_1',
    'address_line_2',
    'city',
    'state',
    'country',
    'postal_code',
    'notes',
])]
class Client extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => ClientType::class,
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
