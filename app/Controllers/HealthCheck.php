<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Database;

class HealthCheck extends BaseController
{
    public function db()
    {
        $db = Database::connect();

        try {
            $db->query("SELECT 1");

            return $this->response->setJSON([
                'status' => 'OK',
                'message' => 'Database is working'
            ]);
        } catch (\Throwable $th) {
            return $this->response
                ->setJSON([
                    'status' => 'ERROR',
                    'message' => 'Database connection failed'
                ])
                ->setStatusCode(500);

        }
    }
}
