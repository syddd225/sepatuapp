<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function createOrder(array $data): Order
    {
        return Order::create($data);
    }
}