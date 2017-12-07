(function() {
  $('.subscribe-form').on('ajaxSuccess', function(ev, context, data, status, jqXHR) {
    if (data.error === true) {
      return console.log(arguments);
    } else {
      return $('.input-group', '.subscribe-form').hide(500);
    }
  });
}).call(this);
