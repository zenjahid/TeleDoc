$(document).ready(function () {
  function checkEmailAvailability() {
    var email = $("#email").val();
    if (email.length > 0) {
      $.post("check_email.php", { email: email }, function (response) {
        if (response == "exists") {
          $("#email").addClass("is-invalid");
          $("#emailError").html("Email already exists");
        } else if (response == "invalid_format") {
          $("#email").addClass("is-invalid");
          $("#emailError").html("Invalid email format");
        } else {
          $("#email").removeClass("is-invalid");
          $("#email").addClass("is-valid");
          $("#emailError").html("");
        }
      });
    } else {
      $("#email").removeClass("is-valid");
      $("#email").removeClass("is-invalid");
      $("#emailError").html("");
    }
  }

  function checkPasswordStrength() {
    var password = $("#password").val();
    var passwordRegex =
      /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+}{":;'?\/\\><.,]).{6,}$/;

    if (passwordRegex.test(password)) {
      $("#password").removeClass("is-invalid");
      $("#password").addClass("is-valid");
      $("#passwordError").html("");
    } else {
      $("#password").addClass("is-invalid");
      $("#passwordError").html(
        "Password must be at least 6 characters long and contain at least one uppercase letter, one number, and one special character."
      );
    }
  }

  function checkPasswordMatch() {
    var password = $("#password").val();
    var confirmPassword = $("#confirmPassword").val();

    if (password === confirmPassword) {
      $("#confirmPassword").removeClass("is-invalid");
      $("#confirmPassword").addClass("is-valid");
      $("#confirmPasswordError").html("");
    } else {
      $("#confirmPassword").addClass("is-invalid");
      $("#confirmPasswordError").html("Passwords do not match");
    }
  }

  // Event listener for email input
  $("#email").on("input", function () {
    checkEmailAvailability();
  });

  // Event listener for password input
  $("#password").on("input", function () {
    checkPasswordStrength();
    checkPasswordMatch();
  });

  // Event listener for confirm password input
  $("#confirmPassword").on("input", function () {
    checkPasswordMatch();
  });
});
