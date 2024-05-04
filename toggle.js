const toggleMenu = document.querySelector(".toggleMenuContainer");
const toggleButton = document.querySelector(".toggler");
const body = document.querySelector("body");

toggleButton.onclick = function toggle() {
    if(!toggleMenu.classList.contains("menuOpen")) {
        toggleMenu.classList.add("menuOpen");
        toggleButton.style.color = "white";
        body.style.overflow = "hidden";
    }
    else {
        toggleMenu.classList.remove("menuOpen");
        body.style.overflow = "auto";
    }
}

window.onscroll = function(e) {
    // print "false" if direction is down and "true" if up
    console.log(this.oldScroll > this.scrollY);
    this.oldScroll = this.scrollY;
  }