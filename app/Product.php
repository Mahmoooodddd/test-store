<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 1/15/20
 * Time: 9:37 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function orderProduct()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function favoriteProduct()
    {
        return $this->hasMany('App\favoriteProduct');
    }


}
