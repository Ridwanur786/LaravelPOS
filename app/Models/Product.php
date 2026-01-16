<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Order_detail;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'description',
        'brand',
        'quantity',
        'price',
        'product_code',
        'barcode',
        'alert_stock'
    ];

    public function orderdetails()
    {
        return $this->hasMany('App\Order_detail');
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
