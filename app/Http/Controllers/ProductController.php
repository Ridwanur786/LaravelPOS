<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Picqer;

use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index',['products'=> $products]);
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
        //var_dump(return $request->all());
        //dd($request);
         $randomcode = rand('012345678', '100000000');
         $red = '244, 0, 0';

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($randomcode, $generator::TYPE_STANDARD_2_5,2,60);

     Product::create($request->all());

     

      $products = new Product();
      $products->product_name = $request->product_name;
      $products->description = $request->description;
      $products->brand = $request->brand;
      $products->price = $request->price;
      $products->quantity = $request->quantity;
      $products->product_code = $randomcode;
      $products->barcode = $barcodes;
      $products->alert_stock = $request->alert_stock;
      $products->save();

            return redirect()->back()->with('Success','Product Added Successfully');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $randomcode = rand('012345678', '100000000');
          $red = '244, 0, 0';

        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($randomcode, $generator::TYPE_STANDARD_2_5,2,60);

    //   Product::create($request->all());

     
     // $product = Product::find($product);
      $product->product_name = $request->product_name;
      
      $product->description = $request->description;
      $product->brand = $request->brand;
      $product->price = $request->price;
      $product->quantity = $request->quantity;
      $product->product_code = $randomcode;
      $product->barcode = $barcodes;
      $product->alert_stock = $request->alert_stock;
      $product->save();

        return back()->with('success', 'product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'user deleted successfully');
    }

    public function GetProductBarcodes()
    {
        $productsBarcode = Product::select('barcode', 'product_code')->get();
        return view('products.barcode.index', compact('productsBarcode'));
    }
}
