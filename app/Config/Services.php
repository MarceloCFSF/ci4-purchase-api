<?php

namespace Config;

use App\Models\Client;
use App\Models\Product;
use App\Services\ClientService;
use App\Services\ProductService;
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

    public static function productService($getShared = true)
    {
        if ($getShared) {
            return self::getSharedInstance('productService');
        }

        return new ProductService(new Product());
    }
}
