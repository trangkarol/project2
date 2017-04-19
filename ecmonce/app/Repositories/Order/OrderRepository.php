<?php

namespace App\Repositories\Order;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class OrderRepository extends BaseRepository implements OrderInterface
{
    /**
    * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    /**
    * function getCategoryLibrary.
     *
     * @return imageName
     */
    public function createOrderMultiple($orders, $orderDetails)
    {
        DB::beginTransaction();
        try {
            $order = parent::create($orders);
            $this->model->find($order->id)->products()->attach($orderDetails);
            $orderDetails = $this->model->with('orderDeatils.product')->where('id', $order->id)->first();
            DB::commit();

            return $orderDetails;
        } catch (\Exception $e) {
            DB::rollback();

            return false;
        }
    }

    /**
     * function getOrders.
     *
     * @return imageName
     */
    public function getOrders()
    {
        return $this->model->with('orderDeatils.product', 'user')->paginate(config('setting.admin.paginate'));
    }

    /**
     * function getOrderUsers.
     *
     * @return imageName
     */
    public function getOrderUsers()
    {
        return $this->model->with('orderDeatils.product', 'user')->where('user_id', Auth::user()->id)->paginate(config('setting.admin.paginate'));
    }
}
