<?php

namespace App\Services\Documents;

use App\Enums\DiscountType;

class DocumentCalculator
{
    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return array{subtotal:int,discount_total:int,tax_total:int,grand_total:int,amount_paid:int,balance_due:int,items:array<int,array<string,int>>}
     */
    public function calculate(array $items, int $amountPaid = 0): array
    {
        $calculatedItems = [];
        $subtotal = 0;
        $discountTotal = 0;
        $taxTotal = 0;
        $grandTotal = 0;

        foreach ($items as $item) {
            $quantity = max((float) ($item['quantity'] ?? 0), 0);
            $unitPrice = max((int) ($item['unit_price'] ?? 0), 0);
            $discountType = $item['discount_type'] ?? DiscountType::None->value;
            $discountValue = max((float) ($item['discount_value'] ?? 0), 0);
            $taxRate = max((float) ($item['tax_rate'] ?? 0), 0);

            $base = (int) round($quantity * $unitPrice);
            $discount = $this->resolveDiscount($base, $discountType, $discountValue);
            $taxableAmount = max($base - $discount, 0);
            $tax = max((int) round($taxableAmount * ($taxRate / 100)), 0);
            $lineTotal = $taxableAmount + $tax;

            $calculatedItems[] = [
                'subtotal' => $base,
                'discount_total' => $discount,
                'tax_total' => $tax,
                'line_total' => $lineTotal,
            ];

            $subtotal += $base;
            $discountTotal += $discount;
            $taxTotal += $tax;
            $grandTotal += $lineTotal;
        }

        $normalizedAmountPaid = max($amountPaid, 0);

        return [
            'subtotal' => max($subtotal, 0),
            'discount_total' => max($discountTotal, 0),
            'tax_total' => max($taxTotal, 0),
            'grand_total' => max($grandTotal, 0),
            'amount_paid' => $normalizedAmountPaid,
            'balance_due' => max($grandTotal - $normalizedAmountPaid, 0),
            'items' => $calculatedItems,
        ];
    }

    private function resolveDiscount(int $base, string $discountType, float $discountValue): int
    {
        if ($base === 0 || $discountValue <= 0) {
            return 0;
        }

        if ($discountType === DiscountType::Fixed->value) {
            return min((int) round($discountValue), $base);
        }

        if ($discountType === DiscountType::Percentage->value) {
            return min((int) round($base * ($discountValue / 100)), $base);
        }

        return 0;
    }
}
