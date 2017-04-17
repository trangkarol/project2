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
