<?php

namespace App\Console\Commands;

use App\OrderProduct;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CalculateProductSell extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teststore:calculate-product-sell';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command calculates prodcut sell every night';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $sellAmount = DB:: table('order_products')
                ->Join('products', 'order_products.product_id', '=', 'products.id')
                ->select( DB::raw('SUM(order_products.number) as sellAmount'))
                ->where('order_products.product_id', '=' , $product->id)->get()->toArray();

                 $product->sell_amount=($sellAmount[0])->sellAmount;
                 $product->save();


            // get all products from product table

            //get all product sell  from orderProduct table

            //save the amount in product table

        }

    }
}
