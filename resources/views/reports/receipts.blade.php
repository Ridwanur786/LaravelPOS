<div id="invoice-POS">

    <center id="top">
        <div class="logo"></div>
        <div class="info">
            <h2>SBISTechs Inc</h2>
        </div>
        <!--End Info-->
    </center>
    <!--End InvoiceTop-->

    <div id="mid">
        <div class="info">
            <h2>Contact Info</h2>
            <p>
                Address : street city, state 0000</br>
                Email : JohnDoe@gmail.com</br>
                Phone : 555-555-5555</br>
            </p>
        </div>
    </div>
    <!--End Invoice Mid-->

    <div id="bot">

        <div id="table">
            <table class="table table-sm table-borderless table-striped">
                <tr class="tabletitle">
                    <td class="item">
                        <h2>Item</h2>
                    </td>
                    <td class="Hours">
                        <h2>Qty</h2>
                    </td>
                    <td class="Hours">
                        <h2>Unit
                        
                        </h2>
                    </td>
                    <td class="Hours">
                        <h2>d(%)</h2>
                    </td>
                    <td class="Rate">
                        <h2>Sub Total</h2>
                    </td>
                </tr>
  @foreach ($order_receipt as $receipt)
         <tr class="service">
                    <td class="tableitem">
                        <p class="itemtext">{{$receipt->product->product_name}}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">{{$receipt->product->quantity}}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">{{number_format($receipt->product->unitprice, 2)}}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">{{$receipt->product->discount ? '' : '0'}}</p>
                    </td>
                    <td class="tableitem">
                        <p class="itemtext">{{number_format($receipt->product->amount, 2)}}</p>
                    </td>
                </tr>
  
                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate">
                        <h2>tax</h2>
                    </td>
                    <td class="payment">
                        <h2>{{number_format($receipt->amount,2)}}</h2>
                    </td>
                </tr>
@endforeach
                <tr class="tabletitle">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="Rate">
                        <h4>Total</h4>
                    </td>
                    <td class="payment">
                        <h4>${{number_format($order_receipt->sum('amount'),2)}}</h4>
                    </td>
                </tr>

            </table>
        </div>
        <!--End Table-->

        <div id="legalcopy">
            <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected within 31 days; please
                process this invoice within that time. There will be a 5% interest charge per month on late invoices.
            </p>
        </div>

    </div>
    <!--End InvoiceBot-->
</div>
<!--End Invoice-->