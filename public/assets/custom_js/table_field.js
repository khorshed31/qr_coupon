function addItem(id, product_id, title, code, qty, price, vat, table) {
    let is_item_added = true

    $('.tr_product_id').each(function (index, value) {
        if ($(this).val() == product_id) {
            is_item_added = false
            let closest_tr = $(this).closest('.mgrid')
            Increase($(this))
            return false
        }
    })

    if (is_item_added == true) {

        let p_vat = Number(vat).toFixed(2)
        let p_total_vat = (Number(vat/100)*Number(price)).toFixed(2)

        let tr = `<tr class="mgrid">
                <td style="width:5%">
                    <span class="serial">${id}</span>
                    <input type="hidden" class="tr_product_id" name="product_ids[]" value="${product_id}" />
                </td>
                <td style="width:15%"> ${title}
                <input type="hidden" name="product_titles[]" value="${title}"/>
                </td>
                <td style="width:15%" class="text-left">
                <input type="hidden" name="product_codes[]" value="${code}"/>
                ${code}
                </td>
                <td style="width:20%" class="text-left">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <a href="javascript:void(0)" onclick="Decrease(this)"><i class="fa fa-minus"
                                        style="color: rgb(126, 3, 3)"></i></a>
                            </span>
                            <input class="form-control product_qty input-sm" id="product-${product_id}" type="number" onkeydown="focusOnEnter(event,'product-search-input')" onkeyup="updateCart(this,event)" name="product_qty[]" value="${qty}">
                            <span class="input-group-addon">
                                <a href="javascript:void(0)" onclick="Increase(this)"><i class="fa fa-plus"></i></a>
                            </span>
                        </div>
                </td>
                <td style="width:20%">
                    <input type="text" name="product_price[]" class="form-control product-cost input-sm" onkeyup="updateCart(this,event)" value="${Number(price).toFixed(2)}"
                        autocomplete="off">
                </td>

                <td style="width:10%">
                    <input type="hidden" name="product_vat[]" value="${p_vat}" class="product_vat"/>
                    <strong>${p_vat}</strong>
                </td>

                <td style="width:15%">
                <input type="hidden" name="subtotal[]" value="${price}"/>
                <strong class="subtotal">${Number(price)+ (Number(vat/100)*Number(price))}</strong>
                </td>

                <td style="display: none">
                <input type="hidden" value="${p_vat}"/>
                <strong class="vat_total">${p_total_vat}</strong>
                </td>
                <td style="width:5%">
                    <a href="javascript:void(0)" class="text-danger" onclick="removeField(this)">
                        <i class="ace-icon fa fa-trash bigger-120"></i>
                    </a>
                </td>
            </tr>`
        table.append(tr)
        calculate()
    }
}



function Decrease(object) {
    let _this = $(object)
    let input = _this.closest('.mgrid').find('.product_qty')
    let qty = input.val()
    if (qty > 1) {
        input.val(Number(qty - 1))
    }
    updateCart(object)
}

function Increase(object) {
    let _this = $(object)
    let input = _this.closest('.mgrid').find('.product_qty')
    let qty = input.val()
    input.val(Number(qty) + 1)
    updateCart(object)
}


function removeField(object) {
    $(object).closest('.mgrid').remove()
    serial()
    calculate()
}
function serial() {
    $('.serial').each(function (index) {
        $(this).text(index + 1)
    })
}

function updateCart(object, event) {



    let _this = $(object).closest('.mgrid')
    let qty = _this.find('.product_qty').val()
    let price = _this.find('.product-cost').val()
    let vat   = _this.find('.product_vat').val()

    if (qty <= 0) {
        qty = 1
        _this.find('.product_qty').val(qty)
    }


    let total = (((Number(qty) * Number(price)) + (Number(qty) * Number(vat/100)*Number(price)))).toFixed(2)
    let vat_total = (Number(qty) * Number(vat/100)*Number(price)).toFixed(2)

    _this.find('.subtotal').text(total)
    _this.find('.vat_total').text(vat_total)


    calculate()



    // if (event.which == 13) {
    //     $('.product-search-input').focus()

    // }
}



function calculate() {
    let price = 0
    let vat = 0

    $('.subtotal').each(function () {
        price += Number($(this).text())
    })

    $('.vat_total').each(function () {
        vat += Number($(this).text())
    })
    // let total       = Number($('#total').val() | 0)
    let delivery_charge = Number($('#delivery_charge').val())
    let discount = Number($('#discount').val())
    let grand_total = (price) - discount
    let paid_amount = Number($('#paid_amount').val())
    let change_amount = Number($('#change_amount').val())
    // console.log(change_amount)
    let due_amount = Math.ceil((grand_total - paid_amount) + change_amount);

    if (delivery_charge){
        due_amount = due_amount + delivery_charge
        $('#due_amount').val(due_amount)
    }

    if (due_amount != 0){

        $(".save-btn").prop("disabled", true);
        $(".save-btn").attr("title","Due amount should be 0");
    }
    else {
        $(".save-btn").prop("disabled", false);
    }




    $('#total').val(price)
    $('#grand_total').val(grand_total)
    $('#due_amount').val(due_amount)
    $('#total_vat').val(vat)

}



    $('#discount,#paid_amount,#delivery_charge,#change_amount').keyup(function () {

        calculate()
    })



// $('#paid_amount').keyup(function () {
//     let _this = $(this)
//     let paid_amount = Number(_this.val() || 0)
//     let grand_total = Number($('#grand_total').val() | 0)
//     $('#due_amount').val(grand_total - paid_amount)

// })





function focusOnEnter(event, id) {


    let keycode = (event.keyCode ? event.keyCode : event.which)

    if (keycode == 13) {
        event.preventDefault()
        $('.' + id).focus()
    }
}
