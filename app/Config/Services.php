<?php

namespace Config;

use App\Models\Client;
use App\Services\ClientService;
use CodeIgniter\Config\BaseService;

class Services extends BaseService
{
    public static function clientService($getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('clientService');
        }

        return new ClientService(new Client());
    }
}
