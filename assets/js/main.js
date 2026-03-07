import { initMobileNav } from "./mobile-nav.js";

document.addEventListener("DOMContentLoaded", () => {
  initMobileNav();
});

const footerLinks = document.getElementById("footerLinks");

function updateFooterLayout() {
  if (window.innerWidth <= 768) {
    footerLinks.style.display = "none";
  } else {
    footerLinks.style.display = "block";
  }
}

updateFooterLayout();
window.addEventListener("resize", updateFooterLayout);
