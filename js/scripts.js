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
        if (x.className === "shopping-cart hide") {
            x.className = "shopping-cart";
        } else {
            x.className = "shopping-cart hide";
        }
    }
}