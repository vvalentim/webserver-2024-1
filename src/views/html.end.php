    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://w3.ind.br/site/assets/js/jquery.mask.min.js"></script>
    <script src="/assets/js/site-ajax.js" async></script>
<script>
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
</script>
</body>
</html>