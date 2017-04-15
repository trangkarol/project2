$(document).ready(function() {
    getSubCategory();
    // click on search
    $(document).on('click', '#btn-search',function() {
        // when event search is firstly
        search(0);
    });

    // change category one
    $(document).on('change', '#category',function() {
        getSubCategory();
    });
});

function getSubCategory() {
    var parent_id = $('#category').val();
    var sub_id = $('#sub_id').val();
    $.ajax({
        type: 'POST',
        url: action['product_sub_category'],
        dataType: 'json',
        data: {
            parent_id: parent_id,
            sub_id: sub_id,
        },
        success:function(data) {
            if (data.result) {
                $('#sub-category').empty();
                $('#sub-category').html(data.html);
            }
        }
    });
}
