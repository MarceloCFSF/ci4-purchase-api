<?php

namespace App\Services;

use App\Exceptions\ValidationException;
use App\Models\Purchase;
use CodeIgniter\Exceptions\RuntimeException;

class PurchaseService
{
  protected Purchase $model;
  protected ProductService $productService;

  public function __construct(Purchase $model)
  {
    $this->model = $model;
    $this->productService = service('productService');
  }

  private function calculateTotal(int $productId, int $quantity): float
  {
    $product = $this->productService->getById($productId);

    if (!$product) {
      throw new RuntimeException(
        'Produto não encontrado',
        404
      );
    }

    return $product['price'] * $quantity;
  }

  public function create(array $data): array
  {
    if (isset($data['product_id']) && isset($data['quantity'])) {
      $data['total'] = $this->calculateTotal(
        $data['product_id'],
        $data['quantity']
      );
    }

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
        'Compra não encontrada',
        404
      );
    }

    return $client;
  }

  public function update(int $id, array $data): array
  {
    $purchase = $this->model->find($id);

    if (!$purchase) {
      throw new RuntimeException(
        'Compra não encontrada',
        404
      );
    }
    
    if (isset($data['product_id']) || isset($data['quantity'])) {
      $data['total'] = $this->calculateTotal(
        $data['product_id'], 
        $data['quantity'] ?? $purchase['quantity']
      );
    }

    if (!$this->model->update($id, $data)) {
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
        'Compra não encontrada',
        404
      );
    }

    return $this->model->delete($id);
  }
}
