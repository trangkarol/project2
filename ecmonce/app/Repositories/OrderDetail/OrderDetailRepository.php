<?php

namespace App\Repositories\OrderDetail;

use App\Models\OrderDetail;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;

class OrderDetailRepository extends BaseRepository implements OrderDetailInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderDetail $orderDetail)
    {
        $this->model = $orderDetail;
    }

    /**
    * function createMmultiple.
     *
     * @return true or false
     */
    public function createMmultiple($orderDetails, $orderId)
    {
        try {
            return $this->model->find($orderId)->attach($orderDetails);
        } catch (\Exception $e) {
            return false;
        }
    }
}
