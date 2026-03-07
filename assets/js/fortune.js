document.addEventListener("DOMContentLoaded", () => {
  const content = document.querySelector("#fortune-box .fortune-content");

  fetch("/api/fortune.php?lang=en")
    .then((res) => res.json())
    .then((data) => {
      content.innerHTML = `
        <div class="fortune-title">Your luck of the day (${data.date})</div>
        <p class="fortune-text">${data.fortune}</p>
      `;
    })
    .catch(() => {
      content.innerHTML = `<p class="fortune-text">Error loading fortune ☹️</p>`;
    });
});
