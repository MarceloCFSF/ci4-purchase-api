<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Services\ClientService;
use App\Transformers\ResponseTransformer;
use CodeIgniter\RESTful\ResourceController;

class ClientController extends ResourceController
{
    use ResponseTransformer;
    protected ClientService $service;

    public function __construct()
    {
        $this->service = service('clientService');
    }

    public function index()
    {
        return $this->collection(
            $this->service->getAll(),
            "Dados retornados com sucesso"
        );
    }

    public function show($id = null)
    {
        try {
            $response = $this->service->getById($id);
            return $this->response(
                $response,
                "Cliente retornado com sucesso"
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
            $data = $this->request->getJSON(true);
            $response = $this->service->create($data);
            return $this->response(
                $response,
                "Cliente criado com sucesso",
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
            $data = $this->request->getJSON(true);
            $response = $this->service->update($id, $data);
            return $this->response(
                $response,
                "Cliente atualizado com sucesso"
            );
        } catch (ValidationException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode(),
                $e->getErrors(),
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode() ?? 500
            );
        }
    }

    public function delete($id = null)
    {
        try {
            $this->service->delete($id);
            return $this->response(
                [],
                "Cliente deletado com sucesso"
            );
        } catch (\RuntimeException $e) {
            return $this->error(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}
