var token = $("#token").text();

$(".confirm-fanauto").confirm({
  text: "Are you sure you want to set fan speed to Auto?",
  title: "Confirmation required",
  confirm: function () {
    $("#fanautoform").submit();
  },
  cancel: function () {
    // nothing to do
  },
  confirmButton: "Yes, set fan to Auto",
  cancelButton: "No, go back",
  post: true,
  confirmButtonClass: "btn-danger",
  cancelButtonClass: "btn-success",
  dialogClass: "modal-dialog"
});

$(".confirm-fanoff").confirm({
  text: "Are you sure you want to turn the fan off?",
  title: "Confirmation required",
  confirm: function () {
    $("#fanoffform").submit();
  },
  cancel: function () {
    // nothing to do
  },
  confirmButton: "Yes, turn fan off",
  cancelButton: "No, go back",
  post: true,
  confirmButtonClass: "btn-danger",
  cancelButtonClass: "btn-success",
  dialogClass: "modal-dialog"
});

$(".confirm-clearfandb").confirm({
  text: "Are you sure you want to the fanspeed database?",
  title: "Confirmation required",
  confirm: function () {
    $("#clearfandbform").submit();
  },
  cancel: function () {
    // nothing to do
  },
  confirmButton: "Yes, clear fanspeed database",
  cancelButton: "No, go back",
  post: true,
  confirmButtonClass: "btn-danger",
  cancelButtonClass: "btn-success",
  dialogClass: "modal-dialog"
});