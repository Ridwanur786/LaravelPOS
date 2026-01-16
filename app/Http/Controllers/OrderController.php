<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        $last_id = Order_detail::max('order_id');
        $order_receipt = Order_detail::where('order_id', $last_id)->get();
        return view('orders.index',
        ['orders'=>$orders,
         'products'=> $products,
         'order_receipt'=>$order_receipt
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        //import DB Transaction class

        DB::transaction(function() use($request)
        {
            //order model
            $order = new Order();
            // \dd($order);
            $order->name = $request->name;
            // $order->phone = $request->phone;
            $order->save();
            $order_id = $order->id;

            //orders details model
        for ($product_id=0; $product_id < \count($request->product_id); $product_id++) { 

            $orders_details = new Order_detail();
            $orders_details->order_id = $order_id;
            $orders_details->product_id = $request->product_id[$product_id];
            $orders_details->quantity= $request->quantity[$product_id];
            $orders_details->amount = $request->total_amount[$product_id];
            $orders_details->unitprice =$request->price[$product_id];
            $orders_details->discount= 0; 
            $orders_details->save();
        }

        $transactions = new Transaction();
        $transactions->order_id= $order_id;
        $transactions->user_id= \auth()->user()->id;
        $transactions->paid_amount= $request->paid_amount;
        $transactions->balance = $request->balance;
        $transactions->payment_method = $request->payment_method;
        $transactions->transac_amount =$orders_details->amount;
        $transactions->transac_date = date('Y-m-d');
        $transactions->save();

        Cart::where('user_id', \auth()->user()->id)->delete();

        $products = Product::all();
        $orders_details =Order_detail::where('order_id',$order_id)->get();
        $orderedBy = Order::where('id',$order_id)->get();

        return \view('orders.index',[
            'products'=> $products,
            'order_details'=>$orders_details,
            'customer_orders'=> $orderedBy
        ]);
        
         });

         return back()->with("Failed to insert product");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
