<?php

namespace App\Transformers;

use CodeIgniter\API\ResponseTrait;

trait ResponseTransformer
{
  use ResponseTrait;

  private function transform($data)
  {
    return $data;
  }

  private function code(int $status)
  {
    return $status == 0 ? 500 : $status;
  }

  public function response(array $body, string $msg, int $status = 200)
  {
    return $this->respond(
      [
        "cabeçalho" => [
          "status" => $this->code($status),
          "mensagem" => $msg,
        ],
        "retorno" => $body,
      ],
      $this->code($status)
    );
  }

  public function error(string $msg, int $status = 500, array $errors = [])
  {
    return $this->response($errors, $msg, $status);
  }

  public function collection(array $items, string $msg, int $status = 200)
  {
    $structuredItems = array_map([$this, 'transform'], $items);

    return $this->response($structuredItems, $msg, $status);
  }
}
