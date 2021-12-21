$(".signup__form").submit(function (e) {
  let fd = new FormData();
  fd.append("email", $("#email").val());
  fd.append("pass", $("#pass").val());
  fd.append("nickname", $("#nickname").val());

  if ($("#pass").val() == $("#passConfirm").val()) {
    $.ajax({
      url: "engine/auth.php?action=signup",
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
  } else {
    $(".form__err").html("Incorrect password");
  }
  e.preventDefault();
});
