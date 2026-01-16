<div class="row">
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="d-flex ">Order Products</h4>

                <a href="#" class="d-flex justify-content-end btn btn-outline-dark btn-sm" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="bi bi-person-plus me-1"></i>Add New Product</a>
            </div>

            {{-- <form action="{{route('orders.store')}}" method="post"> --}}

                <div class="card-body">
                    <form wire:submit.prevent='InsertToCart' method="post">
                        @csrf
                        <input type="text" wire:model="product_code" class="form-control form-control-sm"
                            placeholder="give product code here" name="" id="product_code">
                    </form>
                    @if (session()->has('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                    @elseif(session()->has('info'))
                    <div class="alert alert-info">{{session('info')}}</div>
                    @elseif(session()->has('error'))
                    <div class="alert alert-warning">{{session('error')}}</div>
                    @endif
                    {{-- <div class="alert alert-success">{{$message}}</div> --}}
                    {{-- {{$productInCart}} --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th><a href="#" class="btn btn-sm add_more btn-outline-dark"><i
                                                class="bi bi-plus-circle"></i></a></th>
                                </tr>
                                <thead>
                                <tbody class="addMoreProduct">

                                    @foreach ($productInCart as $key => $item)

                                    <tr>
                                        <td>{{$key +1}}</td>
                                        <td>
                                            <input type="text" class="form-control form-control-sm"
                                                value="{{$item->product->product_name}}">
                                        </td>
                                        <td>
                                            <div class="col-sm-12 d-flex justify-content-between">
                                                <div class="col-sm-2"><button
                                                        class="btn btn-sm btn-sucess btn-outline-success"
                                                        wire:click.prevent="IncrementQty({{$item->id}})"><i
                                                            class="bi bi-plus-circle"></i></button></div>
                                                <div class="col-sm-4">
                                                    <input type="number" class="form-control form-control-sm "
                                                        value="{{$item->product_qty}}">
                                                </div>

                                                <div class="col-sm-2"><button
                                                        class="btn btn-sm btn-sucess btn-outline-danger"
                                                        wire:click.prevent="DecrementQty({{$item->id}})"><i
                                                            class="bi bi-dash-circle"></i></button></div>
                                            </div>


                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm"
                                                value="{{$item->product->price}}">
                                        </td>
                                        <td>
                                            <input type="number" value="{{$item->product->discount}}"
                                                class="form-control form-control-sm">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control form-control-sm "
                                                value="{{$item->product_qty * $item->product->price}}">
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-secondary"><i
                                                    class="bi bi-x-circle"
                                                    wire:click="removeProduct('{{$item->id}}')"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>



    <div class="col-sm-4">
        <div class="card">
            <div class="card-header">Total <b class="total">{{$productInCart->sum('product_price')}}</b></div>
            <form action="{{route('orders.store')}}" method="POST">
                @csrf

                @foreach ($productInCart as $key => $item)


                <input type="hidden" class="form-control form-control-sm" name="product_id[]"
                    value="{{$item->product->id}}">
                <input type="hidden" name="quantity[]" class="form-control form-control-sm "
                    value="{{$item->product_qty}}">
                <input type="hidden" name="price[]" class="form-control form-control-sm"
                    value="{{$item->product->price}}">

                <input type="hidden" name="discount[]" value="{{$item->product->discount}}"
                    class="form-control form-control-sm">

                <input type="hidden" name="total_amount[]" class="form-control form-control-sm "
                    value="{{$item->product_qty * $item->product->price}}">
                @endforeach
                <div class="card-body">
                    <div class="row  d-flex justify-content-center">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic outlined example">
                            <button type="button" id="printbutton" class="btn btn-outline-dark"><i
                                    class="bi bi-printer"></i> Print</button>
                            <button type="button" class="btn btn-outline-info"><i class="bi bi-hourglass-split"></i>
                                History</button>
                            <button type="button" class="btn btn-outline-secondary"><i class="bi bi-flag-fill"></i>
                                Reports</button>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="customer name">Customer Name</label>
                            <input type="text" name="name" id="customer_name" class="form-control form-control-sm">

                        </div>
                        <div class="col-sm-6">
                            <label for="Customer Phone">Customer Phone</label>
                            <input type="number" name="phone" id="customer_phone" class="form-control form-control-sm">

                        </div>

                        <div class="col-sm-12">
                            <div class="payment_title">Payment Method</div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" class="true" type="radio" name="payment_method"
                                    id="payment_method" value="Credit card">
                                <label class="form-check-label" for="payment method"><i
                                        class="bi bi-credit-card-fill"></i>Credit card</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" class="true" type="radio" name="payment_method"
                                    id="payment_method" value="Bank Transfer">
                                <label class="form-check-label" for="payment method"><i class="bi bi-bank2"></i>Bank
                                    Transfer</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" class="true" chacked type="radio" name="payment_method"
                                    id="payment_method" value="cash">
                                <label class="form-check-label" for="payment method"><i
                                        class="bi bi-cash-stack"></i>Cash</label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label for="Customer Payment">Payment</label>
                            <input type="number" name="paid_amount" wire:model="paid_amount" id="paid_amount"
                                class="form-control form-control-sm">

                        </div>
                        <div class="col-sm-12">
                            <label for="Customer Phone">Returning Change</label>
                            <input type="number" name="balance" wire:model="returning_changes" id="balance" readonly
                                class="form-control form-control-sm">

                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-block btn-sm btn-outline-primary">Save</button>
                            <button class="btn btn-block btn-sm btn-outline-secondary">Calculator</button>
                        </div>
                        <div class="col-sm-12 justify-content-center d-flex"><a href="#" class="text-center"><i
                                    class="bi bi-door-closed"></i>Logout</a></div>
                    </div>
                </div>
            </form>
        </div>
    </div>



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
                    <button type="submit" class="btn btn-outline-secondary btn-sm mt-2">ADD Product</button>
                </div>
            </form>
        </div>
    </div>
</div>