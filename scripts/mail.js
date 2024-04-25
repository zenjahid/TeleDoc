$(document).ready(function () {
  $(".check_email").keyup(function (e) {
    let email = $(".check_email").val();
    console.log("Email typed:", email); // Debugging
    $.ajax({
      type: "POST",
      url: "validation/check_mail.php",
      data: {
        check_email: email,
      },
      success: function (response) {
        console.log("Response from server:", response); // Debugging
        let data = JSON.parse(response);
        if (data.available) {
          // Email is available
          $(".error_mail").text("Email is available").css("color", "green");
        } else {
          // Email is already taken
          $(".error_mail").text("Email is already taken").css("color", "red");
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });

  $(".check_username").keyup(function (e) {
    let username = $(".check_username").val();
    console.log("username typed:", username); // Debugging
    $.ajax({
      type: "POST",
      url: "validation/check_username.php",
      data: {
        check_username: username,
      },
      success: function (response) {
        console.log("Response from server:", response); // Debugging
        let data = JSON.parse(response);
        if (data.available) {
          // Username is available
          $(".error_username")
            .text("Username is available")
            .css("color", "green");
        } else {
          // Username is already taken
          $(".error_username")
            .text("Username is already taken")
            .css("color", "red");
        }
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});
