<?php

namespace App\Repositories\OrderDetail;

interface OrderDetailInterface
{
    public function createMmultiple($orderDetails, $orderId);
}
