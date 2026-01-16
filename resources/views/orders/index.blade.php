@extends('layouts.app')
@section('content')
<div class="container-fluid">
    @livewire('order')
    <div class="modal">
        <div id="print">
            @include('reports.receipts');
        </div>
    </div>
    </div>


      
    @endsection