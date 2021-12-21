function changeAccess() {
  let str =
    "admin=" + $(event.target).val() + "&id=" + $(event.target).data("id");
  $.ajax({
    type: "POST",
    url: "engine/adminAction.php?action=changeAccess",
    data: str,
    success: function (answer) {
      $("#userChange").html(answer);
    },
  });
}
