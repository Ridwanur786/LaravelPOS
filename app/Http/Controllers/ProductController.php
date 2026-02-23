<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Picqer;
use Yajra\DataTables\Facades\DataTables;
use App\Providers\AppServiceProvider;

//use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response|\Illuminate\Contracts\View\View
     */
    public function index(Request $request): JsonResponse|\Illuminate\Http\Response|\Illuminate\Contracts\View\View
    {

        if ($request->ajax()) {
            return DataTables::of(Product::query())
                ->addIndexColumn()
                ->editColumn('quantity', fn ($product) => $product->quantity == 0
                    ? '<span class="badge rounded-pill bg-info text-white"> 0</span>'
                    : ($product->quantity <=  $product->alert_stock
                        ? "<span class=\"badge rounded-pill bg-warning text-white\">{$product->quantity}</span>"
                        : "<span class=\"badge rounded-pill bg-success text-white\">{$product->quantity}</span>"))
                ->addColumn('status', function ($product) {

                    if ($product->quantity == 0) {
                        return '<span class="badge rounded-pill bg-info text-white"> OUT OF STOCK</span>';
                    }

                    if ($product->quantity <=  $product->alert_stock) {
                        return '<span class="badge rounded-pill bg-warning text-white"> STOCK LOW</span>';
                    }


                    return '<span class="badge rounded-pill bg-success text-white">IN STOCK</span>';
                })
                ->addColumn('barcode', fn ($product) => "<button class=\"btn btn-secondary btn-sm me-md-2 view-barcode\" type=\"button\"
                                                    data-id=\"{$product->id}\" data-bs-toggle=\"offcanvas\"
                                                    data-bs-target=\"#offcanvasLeft\"><i
                                                        class=\"bi bi-eye\"></i> </button>")
                ->addColumn('action', fn ($product) => "<div class=\"d-grid gap-2 d-md-flex justify-content-md-center\">
                                                <button class=\"btn btn-secondary btn-sm me-md-2 editProduct\" type=\"button\"
                                                    data-bs-toggle=\"offcanvas\"
                                                    data-bs-target=\"#offcanvasScrolling\" data-id=\"{$product->id}\"><i
                                                        class=\"bi bi-pencil\"></i></button>
                                                <button class=\"btn btn-danger btn-sm\" type=\"button\"
                                                    data-bs-toggle=\"offcanvas\"
                                                    data-bs-target=\"#offcanvasTop\" data-id=\"{$product->id}\"><i
                                                        class=\"bi bi-trash2\"></i></button>
                                            </div>")
                ->rawColumns(['quantity', 'status', 'barcode', 'action'])
                ->make(true);
        }
        return view('products.index');
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
    public function store(StoreProductRequest $request, ProductService $productService)
    {

        $product = $productService->store($request->validated());

        return response()->ajaxSuccess($product, 'Product added successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->ajaxSuccess($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return response()->ajaxSuccess($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, Product $product, ProductService $productUpdateService)
    {

        $productUpdateService->update($product, $request->validated);

        return response()->ajaxSuccess([
           
            "Product Updated Successfully",
            $productUpdateService,
            200
        ]);
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
        return response()->ajaxSuccess(null, 'Product deleted successfully', 200);
    }

    // public function GetProductBarcodes()
    // {
    //     $productsBarcode = Product::select('barcode', 'product_code')->get();
    //     return view('products.barcode.index', compact('productsBarcode'));
    // }
}
