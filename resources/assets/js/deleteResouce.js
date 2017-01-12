$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $(document).on('click', 'button#delete', function (event) {
        event.preventDefault();
        if (confirm('Do you wan to remove this ?')) {
            var button = $(this);
            $.post(button.attr('data-url'),
            {
                 _method : 'DELETE',
                '_token' : $('input[name=_token]').val()
            },
            function(data, status){
                button.closest('tr').hide();
            });
        };
    });
//C2
    $(".form-delete").submit(function (event) {
        event.preventDefault();
        if (confirm('Do you wan to remove this ?')) {
            var form = $(this);
            $.post(form.attr('action'), form.serialize(), function(data) {
                form.closest("tr").hide();
            });
        };
    });
});
