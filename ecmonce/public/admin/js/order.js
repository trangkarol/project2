$(document).ready(function() {
    // click on search
    $(document).on('click', '#btn-search', function(){
        search(0);
    });

    // delelete
    $(document).on('click', '.btn-delete', function(event) {
        $(this).parents('.delete-form-user').addClass('current');
        event.preventDefault();
        bootbox.confirm('Are you want to delete?', function(result) {
            if (result) {
                $('.delete-form-user.current').submit();
            }
        });
    });

    //handel pagination by ajax
    $(document).on('click', '.search.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        search(page);
    });

});

function search(page) {
    var data = $('#order-search').serialize();

    url = action['order_search'];
    if (page) {
        url += '?page=' + page;
    }

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success:function(data) {
            console.log(data);
            if (data.result) {
                $('#result-orders').empty();
                $('#result-orders').html(data.html);
                $('.pagination').addClass('search');
                if (page){
                    location.hash='?page='+page;
                }
            }
        }
    });
}
