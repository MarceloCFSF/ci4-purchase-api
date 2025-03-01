<?php

namespace App\Validation;

class DocumentRules
{
  public function cpf(string $cpf, ?string &$error = null): bool
  {
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11) {
      $error = 'CPF must contain 11 digits.';
      return false;
    }

    if (preg_match('/(\d)\1{10}/', $cpf)) {
      $error = 'Invalid CPF.';
      return false;
    }

    for ($t = 9; $t < 11; $t++) {
      $sum = 0;
      for ($i = 0; $i < $t; $i++) {
        $sum += $cpf[$i] * (($t + 1) - $i);
      }
      $digit = ((10 * $sum) % 11) % 10;
      if ($cpf[$i] != $digit) {
        $error = 'Invalid CPF.';
        return false;
      }
    }

    return true;
  }

  public function cnpj(string $cnpj, ?string &$error = null): bool
  {
    $cnpj = preg_replace('/\D/', '', $cnpj);

    if (strlen($cnpj) != 14) {
      $error = 'CNPJ must contain 14 digits.';
      return false;
    }

    if (preg_match('/(\d)\1{13}/', $cnpj)) {
      $error = 'Invalid CNPJ.';
      return false;
    }

    $multipliers1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $multipliers2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    for ($t = 12; $t < 14; $t++) {
      $sum = 0;
      $multipliers = ($t == 12) ? $multipliers1 : $multipliers2;

      for ($i = 0; $i < $t; $i++) {
        $sum += $cnpj[$i] * $multipliers[$i];
      }

      $digit = ($sum % 11 < 2) ? 0 : 11 - ($sum % 11);

      if ($cnpj[$i] != $digit) {
        $error = 'Invalid CNPJ.';
        return false;
      }
    }

    return true;
  }
}
