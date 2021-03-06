"use strict";
lazyload();
let getTheme = window.localStorage && window.localStorage.getItem("tema");
const themeToggle = document.querySelector(".theme-toggle"),
    floatToggle = document.querySelector(".float-toggle");
let isDark = "dark" === getTheme;
function toggleDark() {
    floatToggle.classList.remove("icofont-sun"), floatToggle.classList.add("icofont-moon"), (themeToggle.style.background = "black"), (themeToggle.style.color = "white");
}
function toggleLight() {
    floatToggle.classList.remove("icofont-moon"), floatToggle.classList.add("icofont-sun"), (themeToggle.style.background = "white"), (themeToggle.style.color = "black");
}
null !== getTheme && document.body.classList.toggle("dark-theme", isDark),
    isDark ? toggleLight() : toggleDark(),
    floatToggle.addEventListener("click", () => {
        document.body.classList.toggle("dark-theme"),
            window.localStorage && window.localStorage.setItem("tema", document.body.classList.contains("dark-theme") ? "dark" : "light"),
            "dark" == window.localStorage.getItem("tema") ? toggleLight() : toggleDark();
    });
