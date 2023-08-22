$(function() {

    function showCart(cart) {
        $('#cart-modal .modal-cart-content').html(cart);
        $('#cart-modal').modal();

        let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0;
        $('.mini-cart-qty').text(cartQty);
    }

    $('.add-to-cart-btn').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/electro/services/js-service/cart.php',
            type: 'GET',
            data: {cart: 'add', id: id},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    showCart(res.answer);
                    $('.qty').text(res.cartQty);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error add');
            }
        });
    });
    $('.add-menu-to-cart').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.ajax({
            url: 'http://localhost/electro/services/js-service/cart.php',
            type: 'GET',
            data: {cart: 'add', id: id},
            dataType: 'json',
            success: function (res) {
                if (res.code == 'ok') {
                    showCart(res.answer);
                } else {
                    alert(res.answer);
                }
            },
            error: function () {
                alert('Error add');
            }
        });
    });

    $('#get-cart').on('click', function (e) {
        e.preventDefault();

        $.ajax({
            url: 'http://localhost/electro/services/js-service/cart.php',
            type: 'GET',
            data: {cart: 'show'},
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error show');
            }
        });
    });

    $('#cart-modal .modal-cart-content').on('click', '#clear-cart', function () {
        $.ajax({
            url: 'http://localhost/electro/services/js-service/cart.php',
            type: 'GET',
            data: {cart: 'clear'},
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error clear');
            }
        });
    });

    $('#cart-modal .modal-cart-content').on('click', '#gen-order', function () {
        $.ajax({
            url: 'http://localhost/electro/services/js-service/cart.php',
            type: 'GET',
            data: {cart: 'order'},
            success: function (res) {
                showCart(res);
            },
            error: function () {
                alert('Error add order');
            }
        });
    });
});