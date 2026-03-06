$(function(){
 $('.add_more').on('click',function(){
    var product = $('.product_id').html();
    var numberOfRow = ($('.addMoreProduct tr').length-0)+ 1;
    var tr = '<tr><td class="no">' + numberOfRow + '</td>'+
    '<td> <select name="product_id[]" id="prdouct_id" class="form-control form-control-sm product_id">'
    + product + '</select></td>'+  
 '<td>'+
    '<input type="number" name="quantity[]" id="quantity" class="form-control form-control-sm quantity">' +
   '</td>'+
   '<td>'+
    '<input type="number" name="price[]" id="price" class="form-control form-control-sm price">' +
    '</td>'+
   '<td>'
+    '<input type="number" name="discount[]" id="discount" class="form-control form-control-sm discount">'+
    '</td>' +
    '<td>' +
   '<input type="number" name="total[]" id="total_amount" class="form-control form-control-sm total_amount">' +
   '</td>' +
   '<td>' +
  ' <a href="#" class="btn btn-sm btn-outline-secondary delete"><i class="bi bi-x-circle"></i></a>' +
  '</td>'; 
   $('.addMoreProduct').append(tr);
 });

 $('.addMoreProduct').delegate('.delete','click', function(){
    $(this).parent().parent().remove();
    totalAmountCalculation();
 });

 function totalAmountCalculation(){
    var total = 0;
    $('.total_amount').each(function(i,e){
       var amount = $(this).val()-0;
       total+= amount;
    } );
    $('.total').html(total);

 }
 $('.addMoreProduct').delegate('.product_id','change', function(){
    var tr=$(this).parent().parent();
    var price =tr.find('.product_id option:selected').attr('data-price');
    tr.find('.price').val(price);

    var qty = tr.find('.quantity').val()-0;
    var discount =tr.find('.discount').val()-0;
    var price =tr.find('.price').val()-0;
    var total_amount = (qty * price)-((qty*price*discount)/100);
    tr.find('.total_amount').val(total_amount);
    totalAmountCalculation();
 });

 $('.addMoreProduct').delegate('.quantity, .discount','keyup', function(){
    var tr =$(this).parent().parent();
    var qty = tr.find('.quantity').val()-0;
    var discount =tr.find('.discount').val()-0;
    var price =tr.find('.price').val()-0;
    var total_amount = (qty * price)-((qty*price*discount)/100);
    tr.find('.total_amount').val(total_amount);
    totalAmountCalculation();
 });

$("#paid_amount").keyup(function () {
   var total = $('.total').html();
   var paid_amount = $(this).val();
   var returnAmount = paid_amount - total;
   $('#balance').val(returnAmount).toFixed(2);
});

function printReceipt() {
   
var data = "<input type='button' class='btn btn-sm btn-outline-primary printPageButton btn-block d-block' id='printPageButton' value='Print Receipt' onClick='window.print();'>"; 

      data+= document.getElementById("print").innerHTML;
      salesReceipt = window.open("","contentWindow","left=150, top=130, width=400,height=400");
      salesReceipt.screnX =0;
      salesReceipt.screnY =0;
      salesReceipt.document.write(data);
      salesReceipt.document.title="Print sales Receipt";
      salesReceipt.focus();
   setTimeout(() => {
      salesReceipt.close();
   }, 8000);
}
//printReceipt(el);
$(document).on('click', '#printbutton', function(){
   printReceipt();
   //console.log('hi');
});

});

$(function(){

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
let productsData = $('#productsData').DataTable({
   processing: true,
   serverSide: true,
   responsive: true,
   pagingType: 'full_numbers',
   scrollX: true,
   autoWidth: false,
   lengthMenu: [
          [10, 25, 50, -1],
          [10, 25, 50, "All"]
        ],
   ajax:{
     url: "{{ route('products.index') }}"
   },
   columns: [
            { data: 'DT_RowIndex', orderable:false, searchable:false },
            { data: 'product_name' },
            { data: 'description' },
            { data: 'brand' },
            { data: 'quantity', orderable: false },
            { data: 'product_code' },
            { data: 'barcode', orderable: false, searchable: false },
            { data: 'price' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'action', orderable: false, searchable: false }
        ]

});
//productsData;

  function showCanvasMessage(type, message) {
     const box = $("#offcanvasMessage");
     box.removeClass('alert-success alert-danger alert-warning d-none');

     switch(type) {
         case 'success':
            box.addClass('alert-success');
            break;
         case 'warning':
            box.addClass('alert-warning');
            break;
         case 'error':
            box.addClass('alert-danger');
            break;
          default:
            box.addClass('alert-danger');
     }    
     box.text(message || 'Something went wrong!');
     box.removeClass('d-none');

     setTimeout(() => {
      box.addClass('d-none');

      const canvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasRight'));
      
      if(canvas) canvas.hide();
         

            productsData.ajax.reload(null, false);
        }, 2000);
  }


$('#productForm').on('submit', function (e) {
        e.preventDefault();
       
        $.ajax({
            url: App.routes.productsStore,
            type: "POST",
            data: $(this).serialize(),
            success: function (res) {
               showCanvasMessage('success', res.message);
               // $('#offcanvasRight').offcanvas('hide');
                $('#productForm')[0].reset();

                productsData.ajax.reload(null, false);

                
            },
            error: function (xhr) {
               const res = xhr.responseJSON;

                if (xhr.status === 422) {
                showCanvasMessage('error', 'Validation failed');
            } else if (xhr.status === 403) {
                showCanvasMessage('warning', res?.message ?? 'Unauthorized');
            } else {
                showCanvasMessage('error', res?.message ?? 'Server error');
            }
        
               }
        });
    });


    $(document).on('click', '.editProduct', function(){

      const productId = $(this).data('id');

      $.get('/products/' + productId + '/edit', function(res){

       $('#edit_id').val(res.data.id);
        $('#edit_product_name').val(res.data.product_name);
        $('#edit_description').val(res.data.description);
        $('#edit_brand').val(res.data.brand);
        $('#edit_quantity').val(res.data.quantity);
        $('#edit_price').val(res.data.price);
        $('#edit_alert_stock').val(res.data.alert_stock);
        $('#edit_product_code').val(res.data.product_code);

    });
});


$('#editProductForm').on('submit', function (e) {
        e.preventDefault();
         const id = $('#edit_id').val();

         $.ajax({
            url: '/products/' + id,
            type: "PUT",
            data:$(this).serialize(),
            success: function (res) {
               showCanvasMessage('success', res.message);
                    $('#editProductForm')[0].reset();
                    const canvas = bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasScrolling'));
                    if(canvas) canvas.hide();
            },
         });

      });



});