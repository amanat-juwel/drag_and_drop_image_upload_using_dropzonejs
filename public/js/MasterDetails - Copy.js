$(document).ready(function () {
    //Sub total calculate
    $('#price').keyup(function () {        
        if (!isNaN($('#price').val().trim())) {
            calculatesub();
            $('#price').siblings('span.error').css('visibility', 'hidden');
        }
        else {
            $('#price').siblings('span.error').css('visibility', 'visible');
        }
    });
    $('#price').change(function () {
        if (!isNaN($('#price').val().trim())) {
            calculatesub();
            $('#price').siblings('span.error').css('visibility', 'hidden');
        }
        else {
            $('#price').siblings('span.error').css('visibility', 'visible');
        }
    });
    $('#quantity').keyup(function () {
        if (!isNaN($('#quantity').val().trim()))
        {
            calculatesub();
            $('#quantity').siblings('span.error').css('visibility', 'hidden');
        }
        else
        {
            $('#quantity').siblings('span.error').css('visibility', 'visible');
        }        
    });
    $('#quantity').change(function () {
        if (!isNaN($('#quantity').val().trim())) {
            calculatesub();
            $('#quantity').siblings('span.error').css('visibility', 'hidden');
        }
        else {
            $('#quantity').siblings('span.error').css('visibility', 'visible');
        }
    });
    //Sub total with vat
    $("#vat").change(function () {        
        if ($('#vat').val() != '' && !isNaN($('#vat').val())) {
            calculatesub();
        }
        else {
            $('#quantity').siblings('span.error').css('visibility', 'hidden');
            var textone = Number($('#quantity').val().trim());
            var texttwo = Number($('#price').val().trim());
            var result = textone * texttwo;
            $('#subTotal').val(result.toFixed(2));
        }
    });
    $("#vat").keyup(function () {
        if ($('#vat').val() != '' && !isNaN($('#vat').val())) {
            calculatesub();
        }
        else {
            var textone = Number($('#quantity').val().trim());
            var texttwo = Number($('#price').val().trim());
            var result = textone * texttwo;
            $('#subTotal').val(result.toFixed(2));
        }
    });
    function calculatesub()
    {
        var textone = Number($('#quantity').val().trim());
        var texttwo = Number($('#price').val().trim());
        var vatpercent = Number($('#vat').val().trim());
        var result = textone * texttwo;
        var vat = (result * vatpercent) / 100;
        var itemTotal = result + vat;
        $('#subTotal').val(itemTotal.toFixed(2));
    }
    //Discount with total
    $("#discount").change(function () {
       if (!($('#discount').val() == "0" || $('#discount').val() == '')) {
           var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
           $('#dueAmount').val(itemTotal);
       }
       else {
           var itemTotal = Number($('#totalPrice').val())  - Number($('#advancePaid').val());
           $('#dueAmount').val(itemTotal);
       }
    });
    $("#discount").keyup(function () {
        if ($('#discount').val() != "0" && $('#discount').val() != '') {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }
        else {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }
    });
    //Calculate Due
    $("#advancePaid").change(function () {
        if (!($('#advancePaid').val() == "0" || $('#advancePaid').val() == '')) {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }
        else {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val());
            $('#dueAmount').val(itemTotal);
        }
    });
    $("#advancePaid").keyup(function () {
        if (!($('#advancePaid').val() == "0" || $('#advancePaid').val() == '')) {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }
        else {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val());
            $('#dueAmount').val(itemTotal);
        }
    });

    //Add button click event
    $('#add').click(function () {
        //validation and add order items
        var isAllValid = true;
        if ($('#Item_ID').val() == "0" || $('#Item_ID').val() == "") {
            isAllValid = false;
            $('#Item_ID').siblings('span.error').css('visibility', 'visible');
        }
        else {           
            $('#Item_ID').siblings('span.error').css('visibility', 'hidden');
        }
        if ($('#Stock_Location_ID').val() == "0" || $('#Stock_Location_ID').val() == "") {
            isAllValid = false;
            $('#Stock_Location_ID').siblings('span.error').css('visibility', 'visible');
        }
        else {
            $('#Stock_Location_ID').siblings('span.error').css('visibility', 'hidden');
        }
        if (!($('#quantity').val().trim() != '' && (parseInt($('#quantity').val()) || 0))) {
            isAllValid = false;
            $('#quantity').siblings('span.error').css('visibility', 'visible');
        }
        else {
            $('#quantity').siblings('span.error').css('visibility', 'hidden');
        }

        if (!($('#price').val().trim() != '' && !isNaN($('#price').val().trim()))) {
            isAllValid = false;
            $('#price').siblings('span.error').css('visibility', 'visible');
        }
        else {
            $('#price').siblings('span.error').css('visibility', 'hidden');
        }
        if ((isNaN($('#vat').val().trim()))) {
            isAllValid = false;
            $('#vat').siblings('span.error').css('visibility', 'visible');
        }
        else {
            $('#vat').siblings('span.error').css('visibility', 'hidden');
        }
        if (!($('#subTotal').val().trim() != '' && !isNaN($('#subTotal').val().trim()))) {
            isAllValid = false;
            $('#subTotal').siblings('span.error').css('visibility', 'visible');
        }
        else {

            $('#subTotal').siblings('span.error').css('visibility', 'hidden');
        }
        //totalPrice
        if ($('#totalPrice').val() == '') {
            $('#totalPrice').val($('#subTotal').val());
        } else if (parseFloat($('#totalPrice').val()) > 0) {
            var preTotal = parseFloat($('#totalPrice').val()) + parseFloat($('#subTotal').val());
            $('#totalPrice').val(preTotal);
        }
        if ($('#discount').val() != "0" && $('#discount').val() != '') {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#discount').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }
        else {
            var itemTotal = Number($('#totalPrice').val()) - Number($('#advancePaid').val());
            $('#dueAmount').val(itemTotal);
        }

        //Add New Row With Value


        if (isAllValid) {
            var $newRow = $('#mainrow').clone().removeAttr('id');          
            $('.product', $newRow).val($('#Item_ID').val());
            $('.location', $newRow).val($('#Stock_Location_ID').val());
            $('.subTotal', $newRow).val();
            
            $('#Item_ID',$newRow).attr('name', 'item_id[]');
            $('#Stock_Location_ID',$newRow).attr('name', 'stock_location_id[]');
            $('#quantity',$newRow).attr('name', 'quantity[]');
            $('#price',$newRow).attr('name', 'purchase_price[]');
            $('#vat',$newRow).attr('name', 'vat[]');
            $('#subTotal',$newRow).attr('name', 'item_id[]');

            $('.product', $newRow).val($('#Item_ID').val());
            $('.location', $newRow).val($('#Stock_Location_ID').val());
            $('.quantity', $newRow).val($('#quantity').val());
            $('.price', $newRow).val($('#price').val());
            $('.vat', $newRow).val($('#vat').val());
            // $('.location', $newRow).val($('#Stock_Location_ID').val());

            //Replace add button with remove button
            $('#add', $newRow).addClass('remove').html('<i class="fa fa-minus"></i>').removeClass('blue-hoki').addClass('red-flamingo');

            //remove id attribute from new clone row
            $('#Item_ID,#Stock_Location_ID,#quantity,#price,#vat,#subTotal', $newRow).removeAttr('id').prop("disabled",true);
            $('#add', $newRow).removeAttr('id');
            $('span.error', $newRow).remove();
            //append clone row
            $('#orderdetailsItems').append($newRow);

            //clear select data
            $('#Item_ID,#Stock_Location_ID').val('');
            $('#quantity,#price,#vat,#subTotal').val('');
            $('#orderItemError').empty();
        }

    });

    //remove button click event
    $('#orderdetailsItems').on('click', '.remove', function () {
        var datl = $(this).closest('td').prev('td').find('input').val();
        if (parseFloat($('#totalPrice').val()) > 0) {
            var preTotal = parseFloat($('#totalPrice').val()) - parseFloat(datl);
            var preDue = parseFloat($('#dueAmount').val()) - parseFloat(datl);
            $('#totalPrice').val(preTotal);
            $('#dueAmount').val(preDue);
        }
        $(this).parents('tr').remove();

    });

    $('#submit').click(function () {
        var isAllValid = true;
        var dt = $('#supplier_id').val().trim();
        //validate order items
        $('#orderItemError').text('');
        var list = [];
        var errorItemCount = 0;
        $('#orderdetailsItems tbody tr').each(function (index, ele) {
            if ($('select.product', this).val() == "0" ||
                $('select.location', this).val() == "0" ||
                (parseInt($('.quantity', this).val()) || 0) == 0 ||
                $('.price', this).val() == "" || isNaN($('.price', this).val()) ||
                isNaN($('.vat', this).val())) {
                errorItemCount++;
                $(this).addClass('error');
            } else {
                var orderItem = {
                    Memo_No: $('#memoNo', this).val(),
                    Item_ID: $('select.product', this).val(),
                    Stock_Location_ID: $('select.location', this).val(),
                    Quantity: parseInt($('.quantity', this).val()),
                    Purchase_Price: parseFloat($('.price', this).val()),
                    Item_Vat: parseFloat($('.vat', this).val()),
                }
                list.push(orderItem);
            }
        });

        if (errorItemCount > 0) {
            $('#orderItemError').text(errorItemCount + " invalid entry in order item list.");
            isAllValid = false;
        }

        if (list.length == 0) {
            $('#orderItemError').text('At least 1 order item required.');
            isAllValid = false;
        }

        if ($('#memoNo').val().trim() == '') {
            $('#memoNo').siblings('span.error').css('visibility', 'visible');
            isAllValid = false;
        }
        else {
            $('#memoNo').siblings('span.error').css('visibility', 'hidden');
        }
        if ($('#supplier_id').val() == "0" || $('#supplier_id').val() == "") {
            isAllValid = false;
            $('#supplier_id').siblings('span.error').css('visibility', 'visible');
        }
        else {

            $('#supplier_id').siblings('span.error').css('visibility', 'hidden');
        }
        if ($('#purchaseDate').val().trim() == '') {
            $('#purchaseDate').siblings('span.error').css('visibility', 'visible');
            isAllValid = false;
        }
        else {
            $('#purchaseDate').siblings('span.error').css('visibility', 'hidden');
        }
        if (isNaN($('#dueAmount').val()) || parseFloat($('#dueAmount').val()) < 0)
        {
            $('#dueAmount').siblings('span.error').css('visibility', 'visible');
            isAllValid = false;
        }
        else {
            $('#dueAmount').siblings('span.error').css('visibility', 'hidden');
        }

        if (isAllValid) {
            var data = {
                Memo_No: $('#memoNo').val().trim(),
                Memo_Total: $('#totalPrice').val().trim(),
                Advanced_Amount: $('#advancePaid').val().trim(),
                Discount: $('#discount').val().trim(),
                Supplier_ID: $('#supplier_id').val().trim(),
                Purchase_Date: $('#purchaseDate').val().trim(),
                tbl_purchase_details: list
            }
            $(this).val('Save Order');
            $('#purchase_form').submit();
            $.ajax({
                type: 'POST',
                url: '/InventoryMasterdetails/Save',
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function (data) {
                    if (data.status) {
                        alert('Successfully saved');
                        //here we will clear the form
                        list = [];
                        $('#memoNo,#totalPrice,#advancePaid,#discount,#supplier_id,#purchaseDate').val('');
                        $('#orderdetailsItems').empty();
                        //$('#submit').text("Save Order");
                        $(this).val('Save Order');
                    }
                    else {
                        alert('Error');
                    }
                    //$('#submit').text('Save');
                },
                error: function (error) {
                    console.log(error);
                    //$('#submit').text('Save');
                }
            });
        }

    });

});
// function FillUnit()
// {
//     var item_id = $('#Item_ID').val();
//     $("#unit").val("");
//     $.ajax({
//         url: '/InventoryItem/FillUnit',
//         type: "GET",
//         dataType: "JSON",
//         data: { item_id: item_id },
//         success: function (data) {
//             $("#unit").val(data);
//         }
//     });
// }