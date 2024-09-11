// Designing the mobile menu
const menuLine1 = document.querySelector(".line1");
const menuLine2 = document.querySelector(".line2");
const menuLine3 = document.querySelector(".line3");
const buttonMenu = document.querySelector(".menuToggle");
const openedMenu = document.querySelector(".openedMenu");
const navBar = document.querySelector(".site-header");
const burgerLinks = document.querySelectorAll(".burgerLink");
const hideFooter = document.querySelector(".site-footer");

// Deploy the Menu
buttonMenu.addEventListener("click", () => {
  menuLine1.classList.toggle("line1Transform");
  menuLine2.classList.toggle("hidden");
  menuLine3.classList.toggle("line3Transform");
  buttonMenu.classList.toggle("calibrateCross");
  openedMenu.classList.toggle("openingTheMenu");
  openedMenu.classList.toggle("fixedMenu");
  navBar.classList.toggle("fixedNavBar");
  hideFooter.classList.toggle("hidden");
});

// Close the menu when clicking on links
burgerLinks.forEach((link) => {
  link.addEventListener("click", () => {
    menuLine1.classList.remove("line1Transform");
    menuLine2.classList.remove("hidden");
    menuLine3.classList.remove("line3Transform");
    buttonMenu.classList.remove("calibrateCross");
    openedMenu.classList.remove("openingTheMenu");
    openedMenu.classList.remove("fixedMenu");
    navBar.classList.remove("fixedNavBar");
    hideFooter.classList.remove("hidden");
  });
});

// Close the menu when clicking outside of it
document.addEventListener("click", (event) => {
  if (
    !openedMenu.contains(event.target) &&
    !buttonMenu.contains(event.target)
  ) {
    // Ensure the menu only closes if it's open
    if (openedMenu.classList.contains("openingTheMenu")) {
      menuLine1.classList.remove("line1Transform");
      menuLine2.classList.remove("hidden");
      menuLine3.classList.remove("line3Transform");
      buttonMenu.classList.remove("calibrateCross");
      openedMenu.classList.remove("openingTheMenu");
      openedMenu.classList.remove("fixedMenu");
      navBar.classList.remove("fixedNavBar");
      hideFooter.classList.remove("hidden");
    }
  }
});
