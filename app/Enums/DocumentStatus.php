<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case Draft = 'draft';
    case Sent = 'sent';
    case Viewed = 'viewed';
    case Accepted = 'accepted';
    case Paid = 'paid';
    case PartiallyPaid = 'partially_paid';
    case Cancelled = 'cancelled';
    case Expired = 'expired';
}
