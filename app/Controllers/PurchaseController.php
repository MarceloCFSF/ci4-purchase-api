<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Exceptions\ValidationException;
use App\Services\PurchaseService;
use App\Transformers\RequestTransformer;
use App\Transformers\ResponseTransformer;

class PurchaseController extends BaseController
{
    use RequestTransformer;
    use ResponseTransformer;

    private PurchaseService $purchaseService;

    public function __construct()
    {
        $this->purchaseService = service('purchaseService');
    }

    public function index()
    {
        return $this->response(
            $this->purchaseService->getAll(),
            'Dados retornados com sucesso'
        );
    }

    public function show($id)
    {
        try {
            return $this->response(
                $this->purchaseService->getById($id),
                'Compra retornada com sucesso'
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function create()
    {
        try {
            $data = $this->getBodyParams(true);

            return $this->response(
                $this->purchaseService->create($data),
                'Compra criada com sucesso',
                201
            );
        } catch (ValidationException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode(),
                $e->getErrors()
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function update($id = null)
    {
        try {
            $data = $this->getBodyParams(true);

            return $this->response(
                $this->purchaseService->update($id, $data),
                'Compra atualizada com sucesso'
            );
        } catch (ValidationException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode(),
                $e->getErrors()
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }

    public function delete($id = null)
    {
        try {
            $this->purchaseService->delete($id);

            return $this->response(
                [],
                'Compra deletada com sucesso'
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
