<?php

namespace App\Transformers;

trait RequestTransformer
{
  protected function getBodyParams(bool $assoc = false, int $depth = 512, int $options = 0)
  {
    $body = $this->request->getJSON($assoc, $depth, $options);

    if (!isset($body['parametros'])) {
      throw new \RuntimeException(
        "Tag parametros não encontrada no corpo da requisição",
        400
      );
    }

    return $body['parametros'];
  }
}
