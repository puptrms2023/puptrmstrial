$(document).ready(function() {
    $('#contact-modal').on('show.bs.modal', function () {
      $('.floating-contact').css('display', 'none');
    });

    $('#contact-modal').on('hide.bs.modal', function () {
      $('.floating-contact').css('display', 'block');
    });
  });
