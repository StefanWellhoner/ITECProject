var breakpoint992 = window.matchMedia("(max-width: 992px)");
windowBreakpoint(breakpoint992);
breakpoint992.addListener(windowBreakpoint);

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
        window.location.replace("viewcart.php");
    } else {
        x.classList.toggle("hide");
    }
}

function windowBreakpoint(breakpoint992) {
    var navbar = document.getElementById("topnav");
    var cartModal = document.getElementById("modal-cart");
    if (!breakpoint992.matches) {
        navbar.classList.remove("responsive");
    } else {
        cartModal.classList.add("hide");
    }
}

function editProfile() {
    document.getElementById('submit').classList.toggle('hide');
    document.getElementById('editprofile').classList.toggle('hide');

}

function saveChanges() {
    document.getElementById('submit').classList.toggle('hide');
    document.getElementById('editprofile').classList.toggle('hide');
}