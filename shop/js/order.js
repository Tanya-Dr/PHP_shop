let spanEl = document.querySelector(".order__total");
let total = document.querySelector("#total");
let radioEl = document.querySelectorAll(".order__input");
spanEl.textContent =
  Number(total.value) + Number($("input[name=delivery]:checked").val());

radioEl.forEach(function (el) {
  el.addEventListener("click", function () {
    spanEl.textContent =
      Number(total.value) + Number($("input[name=delivery]:checked").val());
  });
});

$(".order__form").submit(function (e) {
  let fd = new FormData();
  fd.append("address", $("#address").val());
  fd.append("tel", $("#tel").val());
  fd.append("delivery", $("input[name=delivery]:checked").val());
  fd.append("total", $("#total").val());

  $.ajax({
    url: "engine/makeOrder.php",
    data: fd,
    type: "POST",
    processData: false,
    contentType: false,
    success: function (answer) {
      if (answer == "good") {
        location.href = "index.php?page=orderHistory";
      } else {
        $(".form__err").html(answer);
      }
    },
  });
  e.preventDefault();
});
