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

    /**
     * function statisticProduct.
     *
     * @return imageName
     */
    public function statisticProduct()
    {
        return $this->model->with('products')->where('user_id', Auth::user()->id)->paginate(config('setting.admin.paginate'));
    }

    /**
     * function search Order.
     *
     * @return imageName
     */
    public function searchOrder($input)
    {
        try {
            $orders = $this->model;

            if (!is_null($input['date_from'])) {
                $orders = $orders->where('created_at', '>=', $input['date_from'])->where('created_at', '<=', $input['date_to']);
            }

            if (!is_null($input['date_to'])) {
                $orders = $orders->where('created_at', '<=', $input['date_to']);
            }

            if ($input['price_from'] != config('setting.search_default')) {
                $orders = $orders->where('price', '>=', $input['price_from']);
            }

            if ($input['price_to'] != config('setting.search_default')) {
                $orders = $orders->where('price', '<=', $input['price_to']);
            }

            if ($input['status'] == config('setting.search_default')) {
                $orders = $orders->where('status', $input['status']);
            }

            return $orders->paginate(12);
        } catch (\Exception $e) {
            dd($e);
            return false;
        }

    }
}
