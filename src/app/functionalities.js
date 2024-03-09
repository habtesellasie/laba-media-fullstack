const closeButton = document.querySelector(".close");
const menuBar = document.querySelector(".menu-bars");
const navBar = document.querySelector(".nav-bar");
const main = document.querySelector("main");

const menus = document.querySelector(".nav-bar__list-items-holder");
closeButton.style.display = "none";
const header = document.querySelector(".header");

const mainHeight = main.offsetTop - 40;
const topLink = document.querySelector(".top-link");

window.addEventListener("scroll", (e) => {
  // if (window.scrollY >= mainHeight) navBar.classList.add("main-navbar");
  // else navBar.classList.remove("main-navbar");
  const scrollHeight = window.pageYOffset;
  // console.log(scrollHeight);
  if (scrollHeight >= document.querySelector("#footer").offsetTop - 1000)
    topLink.classList.add("show-link");
  else topLink.classList.remove("show-link");
});

const scrollLinks = document.querySelectorAll(".scroll-link");

scrollLinks.forEach((link) => {
  link.addEventListener("click", (e) => {
    e.preventDefault();
    // console.log(e.target);
    const id = e.target.getAttribute("href").slice(1);
    const element = document.getElementById(id);

    const navHeight = navBar.getBoundingClientRect().height;
    let position = element.offsetTop - navHeight;

    if (navHeight > 82) {
      position = position + navHeight;
    }

    window.scrollTo({
      left: 0,
      top: position,
    });
  });
});

const showMenues = (e) => {
  closeButton.style.display = "flex";
  menuBar.style.display = "none";
  menus.classList.add("menus");

  setTimeout(() => {
    closeMenues();
  }, 20000);
};

const closeMenues = (e) => {
  closeButton.style.display = "none";
  menuBar.style.display = "flex";
  menus.classList.remove("menus");
};

menuBar.addEventListener("click", showMenues);
closeButton.addEventListener("click", closeMenues);

window.addEventListener("click", (e) => {
  e.stopPropagation;
  if (
    !e.target.classList.contains("icon-menubar") &&
    !e.target.classList.contains("menus")
  )
    closeMenues();
  else return;
});

const notActiveTabButtons = document.querySelectorAll(".tab-btn");

notActiveTabButtons.forEach((btn) => {
  btn.addEventListener("mouseenter", (e) => {
    let x = e.pageX - btn.offsetLeft;
    let y = e.pageY - btn.offsetTop;

    // btn.style.setProperty("--width-for-hover", 300 + "px");
    btn.style.setProperty("--x-pos", x + "px");
    btn.style.setProperty("--y-pos", y + "px");
  });
});

document.querySelector(".year__container-text").textContent =
  new Date().getFullYear();

const tabBtns = document.querySelectorAll(".tab-btn");
const moreAboutUs = document.querySelector(".more-about-us__container");
const moreAboutUsDescription = document.querySelectorAll(
  ".more-about-us__content"
);

moreAboutUs.addEventListener("click", activateTab);

// tabBtns.forEach((btn, index) => {
//   tabBtns[index].click();
// });

function activateTab(e) {
  const id = e.target.dataset.id;
  if (!id) return;
  tabBtns.forEach((btn) => {
    btn.classList.remove("active");
  });
  e.target.classList.add("active");

  moreAboutUsDescription.forEach((description) => {
    description.classList.remove("active-tab");
  });

  const element = document.getElementById(id);
  element.classList.add("active-tab");
}

// const hoverArea = document.querySelector(".more-about-us__container");
// const paragraphs = document.querySelectorAll(".more-about-us__description");

// let walk = 100;

// function shadow(e) {
//   const { offsetWidth: width, offsetHeight: height } = hoverArea;

//   let { offsetX: x, offsetY: y } = e;
//   if (this !== e.target) {
//     x = x + e.target.offsetLeft;
//     y = y + e.target.offsetTop;
//   }

//   const xWalk = Math.round((x / width) * walk - walk / 2);
//   const yWalk = Math.round((y / height) * walk - walk / 2);
//   paragraphs.forEach((paragraph) => {
//     paragraph.style.textShadow = `${xWalk}px ${yWalk}px 5px var(--clr-blue)`;
//   });
// }

// hoverArea.addEventListener("mousemove", shadow);
