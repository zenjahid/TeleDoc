$(document).ready(function () {
  $(".check_email").keyup(function (e) {
    let email = $(".check_email").val();
    console.log("Email typed:", email); // Debugging
    $.ajax({
      type: "POST",
      url: "check.php",
      data: {
        check_email: email,
      },
      success: function (response) {
        console.log("Response from server:", response); // Debugging
        var data = JSON.parse(response);
        if (data.available) {
          //   alert("Email is available");
          $(".error_mail").text("Email is available");
        } else {
          $(".error_mail").text("Email is already taken");
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});
