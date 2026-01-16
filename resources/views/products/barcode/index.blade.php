@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="d-flex justify-content-start"> Products Barcode</h4>
                </div>
                <div class="card-body">
                    <div id="print">
                        <div class="row">
                            @forelse ($productsBarcode as $barcode)
                            <div class="col-sm-3">
                                {{-- <div class="card">
                                    <div class="card-body"> --}}

                                        {!!$barcode->barcode!!}
                                    {{-- </div>

                                </div> --}}
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
@endsection