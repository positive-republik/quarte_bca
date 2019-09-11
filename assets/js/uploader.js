$(document).ready(function() {
    $('#dataTable').on('click', 'a.mQnA', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $('#mAnswerQnA').modal('show');
        $('#setQnA').load('http://localhost/project_/quarte_bca/uploader/setQnA/' + id );

        $('#answerQnA').submit(function(e) {
            e.preventDefault();

            var form = $(this);

            updateAnswer(form, id);
        });
    });
});

function updateAnswer(form, id) {
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
                $('#mAnswerQnA').modal('hide');
                
                $('#mAnswerQnA').find('.text-danger').remove();
                $('#mAnswerQnA').find('.has-error').removeClass('has-error');
                $('#mAnswerQnA').find('.has-error').removeClass('has-success');

                window.location.href ="http://localhost/project_/quarte_bca/uploader/qna_manage";
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