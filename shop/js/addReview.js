$(".form_review").submit(function (e) {
  let fd = new FormData();
  fd.append("fio", $("#fio").val());
  fd.append("review", $("#review").val());
  fd.append("answer", $("#answer").val());
  fd.append("correct", $("#correct").val());

  $.ajax({
    url: "engine/addReview.php",
    data: fd,
    type: "POST",
    processData: false,
    contentType: false,
    success: function (answer) {
      if (answer == "good") {
        location.href = "index.php?page=review";
      } else {
        $(".form__err").html(answer);
      }
    },
  });
  e.preventDefault();
});
