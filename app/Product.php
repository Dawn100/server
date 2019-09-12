<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name', 'price','description','stock','photo','user_id','category_id'
    // ];

    // // protected $hidden=[
    // //   'user_id'
    // // ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
