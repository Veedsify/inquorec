<?php

namespace App\Enums;

enum DocumentType: string
{
    case Invoice = 'invoice';
    case Quotation = 'quotation';
    case Receipt = 'receipt';
    case Proforma = 'proforma';
    case DeliveryNote = 'delivery_note';
    case Statement = 'statement';
}
