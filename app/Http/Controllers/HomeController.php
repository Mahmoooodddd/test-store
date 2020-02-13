<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();
        $loggedInUser = Auth::user();
        $productData = [];
        if ($loggedInUser == null) {
            foreach ($products as $product) {
                $productData[] = [
                    'id' => $product->id,
                    'price' => $product->price,
                    'name' => $product->name,
                    'isLiked' => false
                ];
            }
        } else {
            $favoriteProducts = $loggedInUser->favoriteProducts()->get();
            $isLiked = false;

            foreach ($products as $product) {
                foreach ($favoriteProducts as $favoriteProduct) {
                    if ($product->id == $favoriteProduct->id) {
                        $isLiked = true;
                        break;
                    }
                }
                $productData[] = [
                    'id' => $product->id,
                    'price' => $product->price,
                    'name' => $product->name,
                    'isLiked' => $isLiked
                ];
            }

        }
        return view('home', ['products' => $productData]);
    }
}
