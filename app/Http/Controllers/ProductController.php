<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 2/15/20
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;


use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        $products = Product::paginate(2);


        return view('product.index',["products" => $products]);


    }

    public function newProduct()
    {
        return view('product.new');

    }

    public function create(Request $request)
    {
        $name =$request->get('name');
        $price =$request->get('price');
        $sellAmount =$request->get('sell_amount');
        $product = new Product();
        $product->name =$name;
        $product->price =$price;
        $product->sell_amount =0;
        $product->created_at =new \DateTime();
        $product->save();

        return redirect('/product/index');

    }

    public function delete($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect('/product/index');

    }

    public function edit($id)
    {
        $product=Product::find($id);
        return view('product.edit',['product'=>$product]);
        
    }

    public function update(Request $request,$id)
    {
        $name =$request->get('name');
        $price =$request->get('price');
        $sellAmount =$request->get('sell_amount');
        $product=Product::find($id);
        $product->name = $name;
        $product->price = $price;
        $product->sell_amount=$sellAmount;
        $product->save();
        return redirect('/product/index');

    }

}
