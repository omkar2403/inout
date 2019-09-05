var showNotification;
showNotification = function(from, align, message, color) {
  // type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];
  // color = Math.floor((Math.random() * 6) + 1);
  // color = 4;
  $.notify({
    icon: "add_alert",
    message: message

  }, {
    type: color,
    delay: 3000,
    placement: {
      from: from,
      align: align
    }
  });
}