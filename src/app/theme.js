const light = document.querySelector(".toggle-light");
const dark = document.querySelector(".toggle-dark");

light.parentElement.style.display = "none";

const darkMode = () => {
  document.documentElement.classList.add("dark-mode");
  dark.parentElement.style.display = "none";
  light.parentElement.style.display = "flex";
  localStorage.setItem("dark-mode", "enabled");
};

const lightMode = () => {
  document.documentElement.classList.remove("dark-mode");
  dark.parentElement.style.display = "flex";
  light.parentElement.style.display = "none";
  localStorage.setItem("dark-mode", null);
};

light.addEventListener("click", () => {
  lightMode();
});

dark.addEventListener("click", () => {
  darkMode();
});

if (localStorage.getItem("dark-mode") === "enabled") darkMode();
else lightMode();
