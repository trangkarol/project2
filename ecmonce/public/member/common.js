    $(document).ready(function () {
    $('#example1').coreSlider({
        pauseOnHover: false,
        interval: 3000,
        controlNavEnabled: true
    });

    $('.value-plus1').on('click', function () {
        var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) + 1;
        divUpd.text(newVal);
    });

    $('.value-minus1').on('click', function () {
        var divUpd = $(this).parent().find('.value1'), newVal = parseInt(divUpd.text(), 10) - 1;
        if(newVal >= 1) divUpd.text(newVal);
    });

    $(document).on('click', '#login', function () {
        getFormLogin();
    });

    $(function () {
        $("#slider").responsiveSlides({
            auto: true,
            nav: true,
            speed: 500,
            namespace: "callbacks",
            pager: true,
        });
    });

    $(document).on('click', '.add-cart', function () {
        $(this).parent().addClass('cart-current');
        addCart();
        $(this).parent().removeClass('cart-current');
        $(this).remove();
    });

    $(document).on('click', '#order', function () {
        event.preventDefault();
        bootbox.confirm(trans['confirm_order'], function(result) {
            if(result) {
                $('.form-order').submit();
            }
        });
    });

    $.ajaxSetup ({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

$(document).ready(function() {
        $('.close1').on('click', function(event) {
            $(this).parents('.cart-detail').addClass('curent-detail-cart');
            bootbox.confirm(trans['confirm_delete_order'], function(result) {
                if(result) {
                    $('.cart-detail.curent-detail-cart').fadeOut('slow', function() {
                        removeCart();
                        $(this).remove();
                    });
                } else {
                    $('.cart-detail').removeClass('curent-detail-cart');
                }
            });
        });
    });

jQuery(function() {
    jQuery('.starbox').each(function() {
        var starbox = jQuery(this);
            starbox.starbox({
            average: starbox.attr('data-start-value'),
            changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
            ghosting: starbox.hasClass('ghosting'),
            autoUpdateAverage: starbox.hasClass('autoupdate'),
            buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
            stars: starbox.attr('data-star-count') || 5
            }).bind('starbox-value-changed', function(event, value) {
            if (starbox.hasClass('random')) {
                var val = Math.random();
                starbox.next().text(' ' + val);
                return val;
            }
        })
    });
});

});
function getFormLogin() {
    $.ajax({
        type: 'GET',
        url: action['get_login'],
        dataType: 'json',
        success:function(data) {
            if (data.result) {
                $.colorbox({ html: data.html });
            }
        }
    });
}

function addCart() {
    var productId = $('.cart-current').find('.cart-product').val();
    var number = $('.cart-current').find('.number-product').val();
    $.ajax({
        type: 'POST',
        url: action['add_cart'],
        dataType: 'json',
        data: {
            productId: productId,
            number: number,
        },
        success:function(data) {
            if (data.result) {
                $('#div-your-cart').empty();
                $('#div-your-cart').html(data.html);
            }
        }
    });
}

function removeCart() {
    var productId = $('.cart-detail.curent-detail-cart').find('.cart-product').val();
    $.ajax({
        type: 'POST',
        url: action['remove_cart'],
        dataType: 'json',
        data: {
            productId: productId,
        },
        success:function(data) {
            console.log(data);
            if (data.result) {
                $('#div-your-cart').empty();
                $('#div-your-cart').html(data.html);
                $('#total-number-cart').text(data.totalNumber);
            }
        }
    });
}
