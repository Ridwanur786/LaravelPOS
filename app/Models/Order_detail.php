<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Order_detail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'amount',
        'unitprice',
        'discount'
    ];

     public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
     public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
