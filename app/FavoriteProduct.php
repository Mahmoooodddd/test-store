<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 1/15/20
 * Time: 9:56 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class FavoriteProduct extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
