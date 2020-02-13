<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index(Request $request)
    {
        $ids = [];
        $sessionProducts = session('products');
        foreach ($sessionProducts as $sessionProduct) {
            $ids[] = $sessionProduct['productId'];
        }
        $products = Product::whereIn('id', $ids)->get();
        $finalProducts = [];
        foreach ($products as $product) {
            $number = 2;
            foreach ($sessionProducts as $sessionProduct) {
                if ($sessionProduct['productId'] == $product->id) {
                    $number = $sessionProduct['number'];
                }
            }
            $finalProducts[] = [
                'productId' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'number' => $number,
                'total' => $product->price * $number
            ];
        }

        return view('basket', ['products' => $finalProducts]);

    }

    public function add(Request $request)
    {
        $productId = $request->get('product_id');
        $sessionProducts = [];
        if (session('products')) {
            $sessionProducts = session('products');
            if (!empty($sessionProducts)) {
                $alreadyExisting = false;
                foreach ($sessionProducts as &$sessionProduct) {
                    if ($sessionProduct['productId'] == $productId) {
                        $alreadyExisting = true;
                        $sessionProduct['number'] += 1;
                    }
                }
                if ($alreadyExisting == false) {
                    $sessionProducts[] = ['productId' => $productId, 'number' => 1];
                }
            } else {
                $sessionProducts[] = ['productId' => $productId, 'number' => 1];
            }
        } else {
            $sessionProducts[] = ['productId' => $productId, 'number' => 1];
        }

        session(['products' => $sessionProducts]);

        return response()->json(['status' => 'success'], 200);
    }

    public function delete(Request $request)
    {
        $productId = $request->get('product_id');

        $sessionProducts = session('products');
        foreach ($sessionProducts as $key => $sessionProduct) {
            if ($sessionProduct['productId'] == $productId) {
                unset($sessionProducts[$key]);
                session(['products' => $sessionProducts]);
            }
        }

        return response()->json(['status' => 'success'], 200);


    }


    public function update(Request $request)
    {
        $productId = $request->get('product_id');
        $number = $request->get('number');
        $sessionProducts = session('products');
        foreach($sessionProducts as $key => $sessionProduct){
            if($sessionProduct['productId']==$productId){
                $sessionProducts[$key]['number']=$number;
            }
        }

        session(['products' => $sessionProducts]);


        return response()->json(['status' => 'success'], 200);

    }


}
