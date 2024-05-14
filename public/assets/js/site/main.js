function enviarLead() {
  var data = {
    name: $("#name").val(),
    phone: $("#phone").val(),
    email: $("#email").val(),
    subject: $("#subject").val(),
    message: $("#message").val(),
  };

  $.ajax({
    url: `${window.location.href}leads/create`,
    data: data,
    type: "POST",
    success: (response) => {
      $("#leadForm").trigger("reset");
      $("#leadSuccess").addClass("div-block");
      $("#leadSuccess").html("Mensagem enviada com sucesso");
      $(".error-message").removeClass("div-block");
    },
    error: (e) => {
      e.responseJSON.message.map((f) => {
        $(`#${f}-error`).addClass("div-block");
      });
    },
  });
}

$(document).ready(() => {
  $("input.phonemasked")
    .mask("(99) 99999-9999")
    .focusout(function (event) {
      var target, phone, element;
      target = event.currentTarget ? event.currentTarget : event.srcElement;
      phone = target.value.replace(/\D/g, "");
      element = $(target);
      element.unmask();
      if (phone.length > 10) {
        element.mask("(99) 9 9999-9999");
      } else {
        element.mask("(99) 9999-9999?9");
      }
    });
});
