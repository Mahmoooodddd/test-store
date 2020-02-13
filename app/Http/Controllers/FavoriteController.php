<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 1/23/20
 * Time: 11:57 AM
 */

namespace App\Http\Controllers;


use App\FavoriteProduct;
use App\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    public function like(Request $request)
    {
        $loggedInUser = Auth::user();
        $productId = $request->get('product_id');
        $product = Product::find($productId);
        if ($product == null) {
            return response()->json(['status' => 'fail'], 404);
        }
        $loggedInUser->favoriteProducts()->attach([$productId]);
        $loggedInUser->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function unLike(Request $request)
    {
        $loggedInUser = Auth::user();
        $productId = $request->get('product_id');
        $product = Product::find($productId);
        if ($product == null) {
            return response()->json(['status' => 'fail'], 404);
        }
        $loggedInUser->favoriteProducts()->detach([$productId]);
        $loggedInUser->save();
        return response()->json(['status' => 'success'], 200);
    }

    public function myFavorites(Request $request)
    {
        $loggedInUser = Auth::user();
//        $favoriteProducts = FavoriteProduct::where("user_id", $loggedInUser->id)->get();
        $favoriteProducts = DB::table('favorite_products')
            ->join('products', 'favorite_products.product_id', "=", "products.id")
            ->where('favorite_products.user_id', $loggedInUser->id)->get();


        return view('favorites.myFavorite', ['favoriteProducts' => $favoriteProducts]);


    }

    public function favorites(Request $request)
    {
        $favoriteProductId = $request->get('favoriteProduct_id');
        $favoriteProducts = FavoriteProduct::where("id", $favoriteProductId)->get();

        $favoriteProductsFinal = [];
        foreach ($favoriteProducts as $favoriteProduct) {
            $favoriteProductsFinal [] = [
                'id' => $favoriteProduct->product->id,
                'name' => $favoriteProduct->product->name,
            ];
        }

        return response()->json(['status' => 'success', 'favoriteProducts' => $favoriteProductsFinal], 200);


    }


}
