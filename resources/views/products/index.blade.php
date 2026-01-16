@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="d-flex justify-content-start">All Products</h4>
                    <a href="#" class="d-flex justify-content-end btn btn-outline-dark" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="bi bi-person-plus me-1"></i>Add Product</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Code</th>
                                    <th>BarCode</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($products as $key => $product)
                                  <?php  dd($product);?> 
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->brand}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{!!$product->barcode!!}</td>
                                        <td>{{number_format($product->price,2)}}</td>
                                        <td>
                                            @if($product->alert_stock > $product->quantity) <span
                                                class="badge rounded-pill bg-info text-dark">{{$product->alert_stock}}
                                                In stock</span>
                                            @elseif($product->alert_stock < $product->quantity) <span
                                                    class="badge rounded-pill bg-warning text-dark">{{$product->alert_stock}}
                                                    Stock Low</span>
                                                @elseif($product->alert_stock == $product->quantity) <span
                                                    class="badge rounded-pill bg-warning text-dark">{{$product->alert_stock}}
                                                    Stock Level</span>
                                                @elseif($product->alert_stock == 0)
                                                <span class="badge rounded-pill bg-danger text-dark">Out of Stock</span>
                                                @else
                                                <span
                                                    class="badge rounded-pill bg-Success text-dark">{{$product->alert_stock}}</span>
                                                @endif
                                        </td>
                                        <td>@if($product->isAdmin==1)
                                            Admin
                                            @else
                                            Cashire
                                            @endif</td>
                                        <td>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                                <button class="btn btn-secondary btn-sm me-md-2" type="button"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasLeft{{$product->id}}"><i
                                                        class="bi bi-pencil"></i> Edit</button>
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasTop{{$product->id}}"><i
                                                        class="bi bi-trash2"></i> Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                
                                  
                                    <div class="offcanvas offcanvas-start" tabindex="-1"
                                        id="offcanvasLeft{{$product->id}}" aria-labelledby="offcanvasRightLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasRightLabel">Edit Product</h5>
                                            <button type="button" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form class="row g-3" action="{{route('products.update',$product->id)}}"
                                                method="post">
                                                @csrf
                                                @method('put')

                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Name</label>
                                                    <input type="text" name="product_name"
                                                        value="{{$product->product_name}}"
                                                        class="form-control form-control-sm" id="inputEmail4">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputEmail4" class="form-label">Description</label>
                                                    <input type="text" name="description"
                                                        value="{{$product->description}}"
                                                        class="form-control form-control-sm" id="inputEmail4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label">Brand</label>
                                                    <input type="text" name="brand" value="{{$product->brand}}" readonly
                                                        class="form-control form-control-sm" id="inputPassword4">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="inputPassword4" class="form-label"> Quantity</label>
                                                    <input type="text" name="quantity" value="{{$product->quantity}}"
                                                        class="form-control form-control-sm" id="inputPassword4">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress" class="form-label">Price</label>
                                                    <input type="number" name="price" value="{{$product->price}}"
                                                        class="form-control form-control-sm" id="inputAddress"
                                                        placeholder="1234 Main St">
                                                </div>
                                                <div class="col-6">
                                                    <label for="inputAddress2" class="form-label">Status</label>
                                                    <input type="text" name="alert_stock"
                                                        value="{{$product->alert_stock}}"
                                                        class="form-control form-control-sm" id="inputAddress2"
                                                        placeholder="phone number">
                                                </div>
                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-outline-secondary btn-sm mt-2">update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                     
                                    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop{{$product->id}}"
                                        aria-labelledby="offcanvasTopLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasTopLabel">Product Delete</h5>
                                            <button type="button" class="btn-close text-reset"
                                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form class="row g-3" action="{{route('products.destroy',$product->id)}}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <h4>Are You Sure you want to delete ? </h4>
                                                <div class="col-12">
                                                    <button type="button" data-bs-dismiss="offcanvas"
                                                        class="btn btn-outline-secondary btn-sm mt-2">Cancel</button>
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm mt-2">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                     @endforeach
                                 </tbody>
                        </table> 
                        {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">Search Products</div>
                <div class="card-body">
                    <form action="">
                        <input type="search" name="userSearch" id="search" class="form-control"
                            placeholder="search products">
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">Toggle right offcanvas</button> --}}

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Add New Product</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="row g-3" action="{{route('products.store')}}" method="post">
                @csrf
                {{-- @method('put') --}}

                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Name</label>
                    <input type="text" name="product_name" class="form-control form-control-sm" id="inputEmail4">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail4" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control form-control-sm" id="inputEmail4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control form-control-sm" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label"> Quantity</label>
                    <input type="text" name="quantity" class="form-control form-control-sm" id="inputPassword4">
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control form-control-sm" id="inputAddress"
                        placeholder="1234 Main St">
                </div>
                <div class="col-6">
                    <label for="inputAddress2" class="form-label">Status</label>
                    <input type="text" name="alert_stock" class="form-control form-control-sm" id="inputAddress2"
                        placeholder="phone number">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-outline-secondary btn-sm mt-2">ADD</button>
                </div>
            </form>
        </div>
    </div>

    @endsection