function search() {
    let search = document.querySelector("#search").value.toLowerCase();
    let contents = document.querySelectorAll(".content"); 
    contents.forEach(content => {
        let h2 = content.querySelector("h2"); 
        if (h2.innerHTML.toLowerCase().indexOf(search) >= 0) {
            content.style.display = ""; 
        } else {
            content.style.display = "none"; 
        }
    });
}