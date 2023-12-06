const body = document.querySelector("body"),
  sidebar = body.querySelector(".sidebar"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  search = body.querySelector(".search"),
  modeSwitch = body.querySelector(".toggle-switch"),
  modeText = body.querySelector(".mode-text");

let getMode = localStorage.getItem("mode");
if (getMode && getMode === "Dark-Mode") {
  body.classList.add("dark");
}

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});

searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
  search.focus();
});

document.addEventListener("DOMContentLoaded", function () {
    updateModeText();
  });
  modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");
    updateModeText();
      const mode = body.classList.contains("dark") ? "Dark-Mode" : "Light-Mode";
    localStorage.setItem("mode", mode);
  });
  function updateModeText() {
    if (body.classList.contains("dark")) {
      modeText.innerText = "Light Mode";
    } else {
      modeText.innerText = "Dark Mode";
    }
  }
  
