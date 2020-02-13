<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 1/15/20
 * Time: 9:57 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function order()
    {
        $this->belongsTo('App\Order');
    }

    public function product()
    {
        return  $this->belongsTo('App\Product');

    }
}
