$(".login__form").submit(function (e) {
  let fd = new FormData();
  fd.append("email", $("#email").val());
  fd.append("pass", $("#pass").val());

  $.ajax({
    url: "engine/auth.php?action=login",
    data: fd,
    type: "POST",
    processData: false,
    contentType: false,
    success: function (answer) {
      if (answer == "good") {
        location.href = "index.php?page=profile";
      } else {
        $(".form__err").html(answer);
      }
    },
  });
  e.preventDefault();
});
