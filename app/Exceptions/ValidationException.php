<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception
{
  protected $errors;

  public function __construct($errors, int $code = 422, ?Throwable $previous = null)
  {
    parent::__construct("Validação falhou", $code, $previous);
    $this->errors = $errors;
  }

  public function getErrors()
  {
    return $this->errors;
  }
}
