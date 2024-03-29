let submit = document.getElementById("submit");
let errEmail = document.getElementById("errEmail");
let errPassword = document.getElementById("errPassword");
let errForm = document.getElementById("errForm");

submit.addEventListener("click", function () {
  let email = document.getElementById("email").value;
  let password = document.getElementById("password").value;

  let request = new XMLHttpRequest();

  request.open("POST", "log-in.php");
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("email=" + email + "&password=" + password);

  request.responseType = "document";
  request.onload = () => {
    let error = request.response.body.innerHTML;

    if (error == "verified") {

        location = "ex.html";
     
    } else {
      //if not connect

      if (error.trim() === "note verified") {
        errForm.style.color = "red";
        errForm.innerHTML = error;
      } else {
        errForm.innerHTML = "";
      }

      if (error.trim() === "email is bad") {
        errEmail.style.color = "red";
        errEmail.innerHTML = error;
      } else {
        errEmail.innerHTML = "";
      }

      if (error.trim() === "password is bad") {
        errPassword.style.color = "red";
        errPassword.innerHTML = error;
      } else {
        errPassword.innerHTML = "";
      }
    }
  };
});
