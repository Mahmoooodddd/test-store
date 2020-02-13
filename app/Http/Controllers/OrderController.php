<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function finish(Request $request)
    {
        DB::beginTransaction();
        try {
            $loggedInUser = Auth::user();
            $order = new Order();
            $order->user_id = $loggedInUser->id;
            $order->status = 'pending';
            $order->save();
            $sessionProducts = session('products');

            foreach ($sessionProducts as $sessionProduct) {
                $orderProduct = new OrderProduct();
                $orderProduct->product_id = $sessionProduct['productId'];
                $orderProduct->number = $sessionProduct['number'];
                $orderProduct->order_id = $order->id;
                $orderProduct->save();
            }
//            throw
            session(['products' => []]);
            DB::commit();
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['status' => 'fail'], 500);
        }


    }

    public function myOrders(Request $request)
    {
//        $orders = Order::where("user_id", $loggedInUser->id)->get();
        $loggedInUser = Auth::user();
        $orders = [DB::table('orders')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->join('products', 'order_products.product_id', '=', 'products.id')
            ->where('orders.user_id', $loggedInUser->id)->get()
        ];


        $ordersFinal = [];
        foreach ($orders[0] as $item) {
            if (count($ordersFinal) > 0) {
                $exists = false;
                foreach ($ordersFinal as $key => $orderFinal) {
                    if ($orderFinal['orderId'] == $item->order_id) {
                        $exists = true;
//                        $orderFinal['products'][]= ["id" => $item->product_id, "name" => $item->name];

                        $products = $orderFinal['products'];
                        $products[] = ["id" => $item->product_id, "name" => $item->name];
                        $orderFinal['products']=$products;
                        $ordersFinal[$key] = $orderFinal;
                    }
                }
                if (!$exists) {
                    $ordersFinal[] =
                        [
                            "orderId" => $item->order_id,
                            "products" => [
                                ["id" => $item->product_id, "name" => $item->name]
                            ]

                        ];
                }
            } else {
                $ordersFinal[] =
                    [
                        "orderId" => $item->order_id,
                        "products" => [
                            ["id" => $item->product_id, "name" => $item->name]
                        ]

                    ];
            }


        }

//        dd($ordersFinal);
        return view ('orders.myOrder', ['orders' => $ordersFinal]);

    }

    public function products(Request $request)
    {
        $orderId = $request->get('order_id');
        $orderProducts = OrderProduct::where("order_id", $orderId)->get();
        $orderProductsFinal = [];
        foreach ($orderProducts as $orderProduct) {
            $orderProductsFinal [] = [
                'product_id' => $orderProduct->product_id,
                'name' => $orderProduct->product->name,
                'number' => $orderProduct->number,
            ];
        }

        return response()->json(['status' => 'success', 'orderProducts' => $orderProductsFinal], 200);
    }

}
