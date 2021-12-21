function addToCart() {
  let str = "id=" + $(event.target).data("id");
  $.ajax({
    type: "POST",
    url: "engine/cartAction.php?action=addToCart",
    data: str,
    success: function (answer) {
      $("#myModal_p").html(answer);
      $("#myModal").css({ display: "block" });
    },
  });
}
$(".close").click(function () {
  $("#myModal").css({ display: "none" });
});
$(window).click(function (e) {
  $("#myModal").css({ display: "none" });
});

function changeQuantity() {
  let str =
    "count=" + $(event.target).val() + "&id=" + $(event.target).data("id");
  $.ajax({
    type: "POST",
    url: "engine/cartAction.php?action=changeCart",
    data: str,
    success: function (answer) {
      location.href = "index.php?page=cart";
    },
  });
}
function deleteFromCart() {
  let str = "id=" + $(event.target).data("id");
  $.ajax({
    type: "POST",
    url: "engine/cartAction.php?action=deleteFromCart",
    data: str,
    success: function (answer) {
      location.href = "index.php?page=cart";
    },
  });
}
function clearCart() {
  $.ajax({
    type: "POST",
    url: "engine/cartAction.php?action=clearCart",
    success: function (answer) {
      location.href = "index.php?page=cart";
    },
  });
}
