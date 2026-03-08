document.addEventListener("DOMContentLoaded", () => {
  const desktopContent = document.querySelector(
    "#fortune-box .fortune-content",
  );
  const mobileContent = document.querySelector(
    ".fortune-card-mobile .fortune-content",
  );

  fetch(BASE_URL + "api/fortune.php?lang=en")
    .then((res) => res.json())
    .then((data) => {
      const html = `
        <div class="fortune-title">Your luck of the day (${data.date})</div>
        <p class="fortune-text">${data.fortune}</p>
      `;

      if (desktopContent) desktopContent.innerHTML = html;
      if (mobileContent) mobileContent.innerHTML = html;
    })
    .catch(() => {
      const errorHtml = `<p class="fortune-text">Error loading fortune ☹️</p>`;

      if (desktopContent) desktopContent.innerHTML = errorHtml;
      if (mobileContent) mobileContent.innerHTML = errorHtml;
    });
});
