let submit = document.getElementById("submit");
let inputs = document.querySelectorAll("input");

// Error elements
let errtourName = document.getElementById("errtourName");
let errtourPrice = document.getElementById("errtourPrice");
let errtourDescription = document.getElementById("errtourDescription");
let errpathimg = document.getElementById("errpathimg");
let verified = document.getElementById("verified");

// Loader
let loader = document.querySelector(".loader");

// Form elements
let tourName = document.getElementById("tourName");
let tourPrice = document.getElementById("tourPrice");
let tourDescription = document.getElementById("tourDescription");
let pathimg = document.getElementById("pathimg");

// Function to clear error messages
function clear() {
    [errtourName, errtourPrice, errtourDescription, errpathimg].forEach(function (e) {
        e.innerHTML = "";
        e.style.color = "red";
    });
}

// Event listener for form submission
submit.addEventListener("click", function () {
    let request = new XMLHttpRequest();
    request.open("POST", "add.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(
        "tourName=" + tourName.value +
        "&tourPrice=" + tourPrice.value +
        "&tourDescription=" + tourDescription.value +
        "&pathimg=" + pathimg.value
    );
    request.responseType = "document";
    request.onload = () => {  
        let response = request.response.body.innerHTML;
        console.log(response);

        if (response.trim().toLowerCase() == "tournameempty") {
            loader.style.display = "none";
            clear();
            errtourName.innerHTML = "tourName is empty!";
        } else if (response.trim().toLowerCase() == "imgempty") {
            loader.style.display = "none";
            clear();
            errpathimg.innerHTML = " * SELECT image ! *";
        } else if (response.trim().toLowerCase() == "notverified") {
            loader.style.display = "none";
            clear();
            verified.innerHTML = "Error 404!";
            verified.style.color = "red";
            verified.style.textShadow = "1px 1px 12px #e7422c";
            setTimeout(function () {
                window.location.replace("error404.php");
            }, 999);
            console.log("no");
        } else if (response.trim().toLowerCase() == "verified") {
            loader.style.display = "block";
            clear();
            let iconVerified = document.createElement("img");
            iconVerified.setAttribute("src", "img/check.gif");
            iconVerified.id = "iconVerified";
            verified.appendChild(iconVerified);
            setTimeout(function () {
                window.location.replace("sql.php");
            }, 999);
            console.log("yes");
        }
    };
    loader.style.display = "block";
});

// Event listener to clear errors on input
inputs.forEach(input => {
    input.addEventListener("input", function () {
        clear();
    });
});
