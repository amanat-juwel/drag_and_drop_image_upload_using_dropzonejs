//     $(document).ready(function () {
//     //Sub total calculate
//     $('#price').keyup(function () {        
//         if (!isNaN($('#price').val().trim())) {
//             calculatesub();
//             $('#price').siblings('span.error').css('visibility', 'hidden');
//         }
//         else {
//             $('#price').siblings('span.error').css('visibility', 'visible');
//         }
//     });
//     $('#price').change(function () {
//         if (!isNaN($('#price').val().trim())) {
//             calculatesub();
//             $('#price').siblings('span.error').css('visibility', 'hidden');
//         }
//         else {
//             $('#price').siblings('span.error').css('visibility', 'visible');
//         }
//     });
//     $('#quantity').keyup(function () {
//         if (!isNaN($('#quantity').val().trim()))
//         {
//             calculatesub();
//             $('#quantity').siblings('span.error').css('visibility', 'hidden');
//         }
//         else
//         {
//             $('#quantity').siblings('span.error').css('visibility', 'visible');
//         }        
//     });
//     $('#quantity').change(function () {
//         if (!isNaN($('#quantity').val().trim())) {
//             calculatesub();
//             $('#quantity').siblings('span.error').css('visibility', 'hidden');
//         }
//         else {
//             $('#quantity').siblings('span.error').css('visibility', 'visible');
//         }
//     });
//     //Sub total with vat
//     $("#vat").change(function () {        
//         if ($('#vat').val() != '' && !isNaN($('#vat').val())) {
//             calculatesub();
//         }
//         else {
//             $('#quantity').siblings('span.error').css('visibility', 'hidden');
//             var textone = Number($('#quantity').val().trim());
//             var texttwo = Number($('#price').val().trim());
//             var result = textone * texttwo;
//             $('#subTotal').val(result.toFixed(2));
//         }
//     });
//     $("#vat").keyup(function () {
//         if ($('#vat').val() != '' && !isNaN($('#vat').val())) {
//             calculatesub();
//         }
//         else {
//             var textone = Number($('#quantity').val().trim());
//             var texttwo = Number($('#price').val().trim());
//             var result = textone * texttwo;
//             $('#subTotal').val(result.toFixed(2));
//         }
//     });
//     function calculatesub()
//     {
//         var textone = Number($('#quantity').val().trim());
//         var texttwo = Number($('#price').val().trim());
//         var vatpercent = Number($('#vat').val().trim());
//         var result = textone * texttwo;
//         var vat = (result * vatpercent) / 100;
//         var itemTotal = result + vat;
//         $('#subTotal').val(itemTotal.toFixed(2));
//     }
//     //Discount with total
//     $("#discount").change(function () {
//        if (!($('#discount').val() == "0" || $('#discount').val() == '')) {
//            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
//            $('#dueAmount').val(itemTotal);
//        }
//        else {
//            var itemTotal = Number($('#totalPrice').val())  - Number($('#advancePaid').val());
//            $('#dueAmount').val(itemTotal);
//        }
//     });
//     $("#discount").keyup(function () {
//         if ($('#discount').val() != "0" && $('#discount').val() != '') {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
//             $('#dueAmount').val(itemTotal);
//         }
//         else {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#advancePaid').val());
//             $('#dueAmount').val(itemTotal);
//         }
//     });
//     //Calculate Due
//     $("#advancePaid").change(function () {
//         if (!($('#advancePaid').val() == "0" || $('#advancePaid').val() == '')) {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
//             $('#dueAmount').val(itemTotal);
//         }
//         else {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val());
//             $('#dueAmount').val(itemTotal);
//         }
//     });
//     $("#advancePaid").keyup(function () {
//         if (!($('#advancePaid').val() == "0" || $('#advancePaid').val() == '')) {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
//             $('#dueAmount').val(itemTotal);
//         }
//         else {
//             var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val());
//             $('#dueAmount').val(itemTotal);
//         }
//     });

//     //remove button click event
//     $('#purchaseTable').on('click', '.remove', function () {
//         // var datl = $(this).closest('td').prev('td').find('input').val();
//         // if (parseFloat($('#totalPrice').val()) > 0) {
//         //     var preTotal = parseFloat($('#totalPrice').val()) - parseFloat(datl);
//         //     var preDue = parseFloat($('#dueAmount').val()) - parseFloat(datl);
//         //     $('#totalPrice').val(preTotal);
//         //     $('#dueAmount').val(preDue);
//         // }
//         $(this).parents('tr').remove();

//     });

//     $('#add').on('click',function(){
//         addRow();
//     });

//     function addRow()
//     {
//         var tr = '<tr class="mycontainer" id="mainrow">'+
//                         '<td>'+
//                             '<select name="item_id[]" id="Item_ID" class="form-control product">'+
//                                 '<option value="">---Select---</option>'+
//                                 '@foreach($items as $item)'+
//                                     '<option value="{{ $item->item_id }}">{{ $item->item_name }}</option>'+
//                                 '@endforeach'+
//                             '</select>'+
//                         '</td>'+
//                         '<td>'+
//                             '<select name="stock_location_id[]" id="Stock_Location_ID" class="form-control location"  >'+
//                                 '<option value="">---Select---</option>'+
//                                 '@foreach($stock_locations as $stock_location)'+
//                                     '<option value="{{ $stock_location->stock_location_id }}">{{ $stock_location->stock_location_name }}</option>'+
//                                 '@endforeach'+
//                             '</select>'+
//                         '</td>'+
//                         '<td>'+
//                             '<input type="text" name="quantity[]" id="quantity" class="quantity form-control">'+
//                         '</td>'+
//                         '<td>'+
//                             '<input type="text" id="price" name="purchase_price[]" class="price form-control">'+
//                         '</td>'+
//                         '<td>'+
//                             '<input type="text" id="vat" name="vat[]" class="vat form-control">'+
//                         '</td>'+
//                         '<td>'+
//                             '<input type="text" id="subTotal"  class="subTotal form-control" placeholder="sub total" disabled="">'+
//                         '</td>'+
//                         '<td>'+
//                             '<button type="button" id="test" class="remove btn dark btn-circle"><i class="fa fa-minus"></i></button>'+
//                         '</td>'+
//                     '</tr>';

//             $('tbody').append(tr);
//     };

//     // $('.remove').on('click',function(){
//     //     $(this).parent().parent().remove();
//     // });


// // var itemBody = $('.item-body') ;

// // itemBody.find('.remove').click(function(){

    
// //     //tr.remove();
// // })
    



// });