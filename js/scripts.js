function collapse() {
    var x = document.getElementById("topnav");
    if (x.className === "navbar") {
        x.className += " responsive";
    } else {
        x.className = "navbar";
    }
}

function cartDropdown() {
    var x = document.getElementById("modal-cart");
    var y = document.getElementById("topnav");
    if (y.className === "navbar responsive") {
        window.location.replace("viewcart.html");
    } else {
        x.classList.toggle("hide");
    }
}