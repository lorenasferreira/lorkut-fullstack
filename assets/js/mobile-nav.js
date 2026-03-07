export function initMobileNav() {
  const btn = document.querySelector(".mnav-btn");
  const drawer = document.querySelector(".mnav-drawer");
  const closeBtn = document.querySelector(".mnav-close");
  const backdrop = document.querySelector(".mnav-backdrop");

  if (!btn || !drawer) return;

  function openDrawer() {
    drawer.classList.add("is-open");
    document.body.classList.add("menu-open");
    if (backdrop) backdrop.hidden = false;
  }

  function closeDrawer() {
    drawer.classList.remove("is-open");
    document.body.classList.remove("menu-open");
    if (backdrop) backdrop.hidden = true;
  }

  function handleDrawerToggle() {
    drawer.classList.contains("is-open") ? closeDrawer() : openDrawer();
  }

  btn.addEventListener("click", handleDrawerToggle);

  if (closeBtn) {
    closeBtn.addEventListener("click", closeDrawer);
  }

  document.addEventListener("click", (e) => {
    if (!drawer.classList.contains("is-open")) return;

    const clickedInsideDrawer = drawer.contains(e.target);
    const clickedMenuBtn = btn.contains(e.target);

    if (!clickedInsideDrawer && !clickedMenuBtn) {
      closeDrawer();
    }
  });

  const tabs = document.querySelectorAll(".pm-tab");
  const contents = document.querySelectorAll(".pm-tab-content");

  tabs.forEach((tab) => {
    tab.addEventListener("click", () => {
      tabs.forEach((t) => t.classList.remove("active"));
      contents.forEach((c) => c.classList.remove("active"));

      tab.classList.add("active");

      const content = document.getElementById(tab.dataset.tab);
      if (content) content.classList.add("active");
    });
  });
}
