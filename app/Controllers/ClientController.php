<?php

namespace App\Controllers;

use App\Exceptions\ValidationException;
use App\Services\ClientService;
use CodeIgniter\RESTful\ResourceController;

class ClientController extends ResourceController
{
    protected ClientService $service;

    public function __construct()
    {
        $this->service = service('clientService');
    }

    public function index()
    {
        return $this->respond($this->service->getAll());
    }

    public function show($id = null)
    {
        try {
            $response = $this->service->getById($id);
            return $this->respond($response);
        } catch (\RuntimeException $e) {
            return $this->fail(
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
            return $this->respondCreated($response);
        } catch (ValidationException $e) {
            return $this->fail(
                $e->getErrors(),
                $e->getCode()
            );
        } catch (\RuntimeException $e) {
            return $this->failServerError(
                $e->getMessage(),
                $e->getCode() ?? 500
            );
        }
    }
    
    public function update($id = null)
    {
        try {
            $data = $this->request->getJSON(true);
            $response = $this->service->update($id, $data);
            return $this->respondUpdated($response);
        } catch (ValidationException $e) {
            return $this->fail(
                $e->getErrors(),
                $e->getCode()
            );
        } catch (\RuntimeException $e) {
            return $this->failServerError(
                $e->getMessage(),
                $e->getCode() ?? 500
            );
        }
    }

    public function delete($id = null)
    {
        try {
            $this->service->delete($id);
            return $this->respondDeleted();
        } catch (\RuntimeException $e) {
            return $this->fail(
                $e->getMessage(),
                $e->getCode()
            );
        }   
    }
}
