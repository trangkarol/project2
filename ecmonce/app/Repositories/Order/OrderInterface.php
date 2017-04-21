<?php

namespace App\Repositories\Order;

interface OrderInterface
{
    public function createOrderMultiple($orders, $orderDetails);

    public function getOrders();
    public function getOrderUsers();
}