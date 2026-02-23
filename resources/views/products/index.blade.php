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
                        <table class="table table-bordered table-striped table-hover" id="productsData">
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
                                    <th>Actions</th>
                                </tr>
                                </thead>
                              
                        </table> 
                        
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
   
<!-- Add Product Canvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Add New Product</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="row g-3" action="{{route('products.store')}}" method="post" id="productForm">
            <input type="hidden" id="product_id">   
            @csrf
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
                        placeholder="price">
                </div>
                <div class="col-6">
                    <label for="inputAddress2" class="form-label">Status</label>
                    <input type="text" name="alert_stock" class="form-control form-control-sm" id="inputAddress2"
                        placeholder="In/Out of stock">
                </div>
                <div id="offcanvasMessage" class="alert d-none"></div>
                <div class="col-12">
                    <button type="submit" id="btnSubmit" class="btn btn-outline-secondary btn-sm mt-2">ADD</button>
                </div>
            </form>
        </div>
    </div>

<!-- Update Product Canvas -->
    <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasScrolling" data-bs-scroll="true" data-bs-backdrop="false"
     aria-labelledby="offcanvasEditLabel" style="height:auto; max-height: 60vh;">

    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasEditLabel" class="mb-0">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body pt-2">

        <form id="editProductForm">
            @csrf
            @method('PUT')

            <input type="hidden" id="edit_id">

            <div class="container-fluid">
                <div class="row g-1">

                    <!-- Product Name -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label small">Name</label>
                            <div class="col-10">
                                <input type="text" id="edit_product_name" name="product_name"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Brand -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Brand</label>
                            <div class="col-10">
                                <input type="text" id="edit_brand" name="brand"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <input type="text" id="edit_description" name="description"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Quantity</label>
                            <div class="col-10">
                                <input type="number" id="edit_quantity" name="quantity"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Price</label>
                            <div class="col-10">
                                <input type="number" id="edit_price" name="price"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Alert Stock -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Alert</label>
                            <div class="col-10">
                                <input type="number" id="edit_alert_stock" name="alert_stock"
                                       class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Barcode -->
                    <div class="col-md-6">
                        <div class="row align-items-center">
                            <label class="col-2 col-form-label">Product Code</label>
                            <div class="col-10">
                                <textarea id="edit_product_code" name="product_code"
                                    class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Message -->
            <div id="editMessage" class="alert mt-3 d-none"></div>

            <!-- Buttons -->
            <div class="text-end mt-2">
                <button type="submit" class="btn btn-primary btn-sm">
                    Update Product
                </button>
            </div>

        </form>

    </div>
</div>


    @endsection