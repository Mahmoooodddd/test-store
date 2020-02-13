<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 1/15/20
 * Time: 9:56 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function orderProducts()
    {
        $this->hasMany('App\OrderProduct');
    }
}
