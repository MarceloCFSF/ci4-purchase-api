<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Services\ProductService;
use App\Transformers\ResponseTransformer;
use CodeIgniter\RESTful\ResourceController;

class ProductController extends ResourceController
{
    use ResponseTransformer;

    protected ProductService $productService;

    public function __construct()
    {
        return $this->productService = service('ProductService');
    }

    public function index()
    {
        return $this->collection(
            $this->productService->getAll(),
            'Dados retornados com sucesso'
        );
    }

    public function show($id = null)
    {
        try {
            return $this->response(
                $this->productService->getById($id),
                'Dados retornados com sucesso'
            );
        } catch (\RuntimeException $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);

            return $this->response(
                $this->productService->create($data),
                'Produto criado com sucesso',
                201
            );
        } catch (ValidationException $e) {
            return $this->error(
                $e->getMessage(), 
                $e->getCode(),
                $e->getErrors()
            );
        } catch (\RuntimeException $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true);

            return $this->response(
                $this->productService->update($id, $data),
                'Produto atualizado com sucesso'
            );
        } catch (ValidationException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode(),
                $e->getErrors()
            );
        } catch (\RuntimeException $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function delete($id = null)
    {
        try {
            $this->productService->delete($id);

            return $this->response(
                [],
                'Produto deletado com sucesso'
            );
        } catch (\RuntimeException $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
