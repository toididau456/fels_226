$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    $(document).on('click', 'button#delete', function(event) {
        var url = $(this);
        $.post(url.attr('data-url'),
        {
             _method : 'DELETE',
             '_token' : $('inputp[name=_token]').val()
        },
        function(data, status){
            url.closest('tr').hide();
        });
    });
//C2
    $(".form-delete").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(data) {
            form.closest("tr").hide();
        });
    });
});