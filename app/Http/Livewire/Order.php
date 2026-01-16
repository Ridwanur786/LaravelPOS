<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;

class Order extends Component
{
    public $products=[], $order, $product_code, $message = '', $productInCart;
    public $paid_amount = '', $returning_changes='';

    public function mount()
    {
        $this->products= Product::all();
        $this->productInCart=Cart::all();
    }
    public function InsertToCart()
    {
        $countProduct = Product::where('id', $this->product_code)->first();
        // dd($countProduct);

        if(!$countProduct)
        {
             return \session()->flash('info', 'Product 
             Not found , please add this product first');
        }else{

        $cartCountProduct = Cart::where('product_id', $this->product_code)->count();
        if($cartCountProduct > 0)
        {
            // return $this->message = $countProduct->product_name .'is already exists';
             return \session()->flash('info', 'Product' . $countProduct->product_name .  
             'is already exists');
        }else
        {
            $add_to_cart = new Cart();
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->product_qty = 1;
            $add_to_cart->product_price = $countProduct->price;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();

            $this->productInCart->prepend($add_to_cart);


        }
        $this->product_code = '';
        // return $this->message= 'product added successfully';
         return \session()->flash('info', 'Product' . $countProduct->product_name .  
             'Added successfully in the cart');
        }

        
    }

    public function IncrementQty($cart_id)
    {
        $addProduct = Cart::find($cart_id);
        $addProduct->increment('product_qty', 1);
        $updatePrice = $addProduct->product_qty * $addProduct->product->price;
        $addProduct->update(['product_price'=>$updatePrice]);
        $this->mount();
    }

    public function DecrementQty($cart_id)
    {
        $addProduct = Cart::find($cart_id);
        if($addProduct->product_qty == 1){
            return \session()->flash('info', 'Product' . $addProduct->product->product_name . 
             'Quantity can not be less then 1 . please remove item from cart or add new one.');
        }
        $addProduct->decrement('product_qty', 1);
        $updatePrice = $addProduct->product_qty * $addProduct->product->price;
        $addProduct->update(['product_price'=>$updatePrice]);
        $this->mount();
    }

    public function removeProduct($cart_id)
    {
        $cartDelete = Cart::find($cart_id);
        $cartDelete->delete();
          return \session()->flash('error', 'Product' . ' ' .$cartDelete->product->product_name . ' '. 
             'removed from the cart');

        $this->productInCart = $this->productInCart->except($cart_id);

    }
    public function render()
    {

       
        if ($this->paid_amount !== '') {

             $money = (int)$this->paid_amount;
        $total = (int)$this->productInCart->sum('product_price');
            $totalAmount =$money - $total ;
        $this->returning_changes= $totalAmount; 
        }
        
        return view('livewire.order');
    }
}
