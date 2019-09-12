<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name', 'price','description','stock','category_id','photo','user_id'
    // ];

    // protected $hidden=[
    //   'created_at','updated_at','user_id','category_id'
    // ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
