function enviarLead(){
    var data = {
        name: $('#name').val(),
        phone: $('#phone').val(),
        email: $('#email').val(),
        subject: $('#subject').val(),
        message: $('#message').val(),
    };

    $.ajax({
        url: `${window.location.href}leads/create`,
        data: data,
        type: "POST",
        success: (response) => {
            $('#leadForm').trigger("reset");
            $('#leadSuccess').addClass('div-block');
            $('#leadSuccess').html('Mensagem enviada com sucesso');
            $('.error-message').removeClass('div-block');
        },
        error: (e) => {
            e.responseJSON.message.map(f => {
                $(`#${f}-error`).addClass('div-block');
            });
        }
    });
}