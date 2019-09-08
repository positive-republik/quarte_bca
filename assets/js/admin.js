$(document).ready(function() {

    // Set Edit
    $('#dataTable').on('click', 'button.btnEdit', function() {
        var id = $(this).data('id');
        editUser(id);
    });

    // Update Data
    $('form#updateData').on('submit', function(e) {
        e.preventDefault();
        var id = $('input[name=id]').val();
        var form = $(this);
        updateUser(form, id);
    });

    // Delete Data
    $('#dataTable').on('click', 'button.mDelete', function() {
        var id = $(this).data('id');
        $('#deleteUser').modal('show');

        $('#deleteUser').on('click', 'button.btnDelete', function() {
            window.location.href="http://localhost/project_/quarte_bca/Admin/delete/" + id;
        });

    });
});

function editUser(id) {
    $('#editData').load('http://localhost/project_/quarte_bca/Admin/setData/' + id);
}

function updateUser(form, id) {
    $.ajax({
        url: form.attr('action') + id,
        data: form.serialize(),
        dataType: 'json',
        method: 'post',
        success: function(response) 
        {
            if ( response.success == true )
            {
                
                form[0].reset();
                $('#editUser').modal('hide');
                
                $('#editUser').find('.text-danger').remove();
                $('#editUser').find('.has-error').removeClass('has-error');
                $('#editUser').find('.has-error').removeClass('has-success');

                window.location.href="http://localhost/project_/quarte_bca/";
            }
            else
            {
                $.each(response.messages, function(key, value) {
                    var element = $('#' + key);
              
                    element.closest('div.form-group')
                    .removeClass('has-error')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success')
                    .find('.text-danger')
                    .remove();
                    
                    element.after(value);
                });
            }
        }
    });
}
