// function addCartProduct(productId, qty)
// {
//     var url = '/cart/add-product';
//
//     var data = {
//         "productId": productId,
//         "quantity": qty
//     };
//
//     $.post(url, data, function(data, status) {
//         if(data.status=="error") {
//             alert(data.error_message);
//         }
//         window.location.href = "/cart";
//     });
// }

function changeCartProductQty(productId, qty)
{
    var url = '/cart/change-product-quantity';

    var data = {
        "productId": productId,
        "quantity": qty
    };

    $.post(url, data, function (data, status) {
        if (data.status == "error") {
            bootbox.alert(data.error_message, function (result) {
                window.location.href = "/cart";
            });
        } else {
            window.location.href = "/cart";
        }
    });
}

function removeCartProduct(productId)
{
    changeCartProductQty(productId, 0);
}

function emptyCart()
{
    $.get('/cart/empty', function() {
        window.location.href = "/cart";
    });
}
