<?php

use App\Enums\DiscountType;
use App\Services\Documents\DocumentCalculator;

it('calculates item and document totals', function (): void {
    $calculator = new DocumentCalculator();

    $result = $calculator->calculate([
        [
            'quantity' => 2,
            'unit_price' => 10000,
            'discount_type' => DiscountType::Percentage->value,
            'discount_value' => 10,
            'tax_rate' => 7.5,
        ],
        [
            'quantity' => 1,
            'unit_price' => 5000,
            'discount_type' => DiscountType::Fixed->value,
            'discount_value' => 2000,
            'tax_rate' => 0,
        ],
    ], 3000);

    expect($result)->toMatchArray([
        'subtotal' => 25000,
        'discount_total' => 4000,
        'tax_total' => 1350,
        'grand_total' => 22350,
        'amount_paid' => 3000,
        'balance_due' => 19350,
    ]);
});

it('clamps discount and balance due to zero', function (): void {
    $calculator = new DocumentCalculator();

    $result = $calculator->calculate([
        [
            'quantity' => 1,
            'unit_price' => 1000,
            'discount_type' => DiscountType::Fixed->value,
            'discount_value' => 5000,
            'tax_rate' => 5,
        ],
    ], 10000);

    expect($result)->toMatchArray([
        'subtotal' => 1000,
        'discount_total' => 1000,
        'tax_total' => 0,
        'grand_total' => 0,
        'balance_due' => 0,
    ]);
});
