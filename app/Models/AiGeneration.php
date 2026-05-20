<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'business_id',
    'user_id',
    'document_id',
    'feature',
    'input_text',
    'output_json',
    'model',
    'status',
    'error_message',
    'tokens_input',
    'tokens_output',
])]
class AiGeneration extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'output_json' => 'array',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
