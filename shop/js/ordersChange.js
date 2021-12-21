function changeStatus() {
  let str =
    "status=" +
    $(event.target).val() +
    "&idOrder=" +
    $(event.target).data("id");
  $.ajax({
    type: "POST",
    url: "engine/adminAction.php?action=changeStatus",
    data: str,
    success: function (answer) {
      $("#statusChange").html(answer);
    },
  });
}
