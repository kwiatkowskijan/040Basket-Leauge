const toggleMenu = document.querySelector(".toggleMenuContainer");
const toggleButton = document.querySelector(".toggler");
const body = document.querySelector("body");

toggleButton.onclick = function toggle() {
    if(toggleMenu.style.visibility === "hidden") {
        toggleMenu.style.visibility = "visible";
        toggleMenu.style.opacity = "0.85";
        toggleButton.style.color = "white";
        body.style.overflow = "hidden";
    }
    else {
        toggleMenu.style.visibility = "hidden";
        toggleMenu.style.opacity = "0";
        toggleButton.style.color = "black";
        body.style.overflow = "auto";
    }
}