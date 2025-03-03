<?php

namespace App\Enums;

enum PurchaseStatus: string
{
  case PENDING = 'Em Aberto';
  case PAID = 'Pago';
  case CANCELED = 'Cancelado';

  public static function values(): string
  {
    return implode(',', array_column(self::cases(), 'value'));
  }
}
