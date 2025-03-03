<?php

namespace App\Services;

use App\Exceptions\ValidationException;
use App\Models\Client;
use CodeIgniter\Exceptions\RuntimeException;

class ClientService
{
  protected Client $model;

  public function __construct(Client $model)
  {
    $this->model = $model; 
  }

  public function create(array $data): array
  {
    if (!$this->model->insert($data)) {
      throw new ValidationException(
        $this->model->errors()
      );
    }

    return $this->model->find($this->model->insertID());
  }

  public function getAll(): array
  {
    return $this->model->findAll();
  }

  public function getById(int $id): array
  {
    $client = $this->model->find($id);

    if (!$client) {
      throw new RuntimeException(
        'Cliente não encontrado',
        404
      );
    }

    return $client;
  }

  public function update(int $id, array $data): array
  {
    if (!$this->model->find($id)) {
      throw new RuntimeException(
        'Cliente não encontrado',
        404
      );
    }

    if(!$this->model->update($id, $data)) {
      throw new ValidationException(
        $this->model->errors()
      );
    }

    return $this->model->find($id);
  }

  public function delete(int $id): bool
  {
    if (!$this->model->find($id)) {
      throw new RuntimeException(
        'Cliente não encontrado',
        404
      );
    }
    
    return $this->model->delete($id);
  }
}
