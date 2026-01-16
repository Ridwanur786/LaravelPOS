JQuery(document).ready(function(JQuery){
 JQuery('.add_more').on('click',function(){
    var product = JQuery('.product_id').html();
    var numberOfRow = (JQuery('.addMoreProduct tr').length-0)+ 1;
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
   JQuery('.addMoreProduct').append(tr);
 });

 JQuery('.addMoreProduct').delegate('.delete','click', function(){
    JQuery(this).parent().parent().remove();
    totalAmountCalculation();
 });

 function totalAmountCalculation(){
    var total = 0;
    JQuery('.total_amount').each(function(i,e){
       var amount = JQuery(this).val()-0;
       total+= amount;
    } );
    JQuery('.total').html(total);

 }
 JQuery('.addMoreProduct').delegate('.product_id','change', function(){
    var tr=JQuery(this).parent().parent();
    var price =tr.find('.product_id option:selected').attr('data-price');
    tr.find('.price').val(price);

    var qty = tr.find('.quantity').val()-0;
    var discount =tr.find('.discount').val()-0;
    var price =tr.find('.price').val()-0;
    var total_amount = (qty * price)-((qty*price*discount)/100);
    tr.find('.total_amount').val(total_amount);
    totalAmountCalculation();
 });

 JQuery('.addMoreProduct').delegate('.quantity, .discount','keyup', function(){
    var tr =JQuery(this).parent().parent();
    var qty = tr.find('.quantity').val()-0;
    var discount =tr.find('.discount').val()-0;
    var price =tr.find('.price').val()-0;
    var total_amount = (qty * price)-((qty*price*discount)/100);
    tr.find('.total_amount').val(total_amount);
    totalAmountCalculation();
 });

JQuery("#paid_amount").keyup(function () {
   var total = JQuery('.total').html();
   var paid_amount = JQuery(this).val();
   var returnAmount = paid_amount - total;
   JQuery('#balance').val(returnAmount).toFixed(2);
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
JQuery(document).on('click', '#printbutton', function(){
   printReceipt();
   //console.log('hi');
});

 });
