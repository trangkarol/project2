$(document).ready(function() {
    // delelete
    $(document).on('click', '#export-file', function(event) {
        event.preventDefault();
        bootbox.confirm('Are you want to export file?', function(result) {
            if (result) {
                $('#form-export').submit();
            }
        });
    });
});
