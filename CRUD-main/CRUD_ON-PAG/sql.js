// Select submit buttons
let submits = document.querySelectorAll(".submit");

// Select input fields
let inputs = document.querySelectorAll("input");

// Element references
let tourName = document.getElementById("tourName");
let tourPrice = document.getElementById("tourPrice");
let tourDescription = document.getElementById("tourDescription");

// Clear fields function
function clearFields() {
    [tourName, tourPrice, tourDescription].forEach(function (e) {
        e.style.background = "";
        e.style.color = "red";
    });
}

// Attach event listeners to submit buttons
submits.forEach(submit => {
    submit.addEventListener("click", function() {
        let request = new XMLHttpRequest();
        request.open("POST", "sql.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send(
            "tourName=" + tourName.value +
            "&tourPrice=" + tourPrice.value +
            "&tourDescription=" + tourDescription.value 
        );
        request.responseType = "document";
        request.onload = () => {
            response = request.response.body.innerHTML;
            console.log(response);  
            if (response.trim().toLowerCase() == "emptytourName") {
                tourName.style.background = "red";
                clearFields();
            } else if (response.trim().toLowerCase() == "emptytourPrice") {
                tourPrice.style.background = "red";
                clearFields();
            } else if (response.trim().toLowerCase() == "emptytourDescription" ) {
                tourDescription.style.background = "red";
                clearFields();
            } else if ( response.trim().toLowerCase() == "noteconnected") {
                submit.style.background = "red";
                clearFields();
            }
        }; //onload
        this.style.background = ""; // Reset submit button style
    }); //click

    // Attach input event listeners to clear fields on input change
    inputs.forEach(input => {
        input.addEventListener("input", function() {
            clearFields();
        });
    });
});
