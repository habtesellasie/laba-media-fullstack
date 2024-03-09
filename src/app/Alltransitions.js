const counts = [...document.querySelectorAll(".counts")];
const updateCount = (element) => {
  const value = parseInt(element.dataset.value);
  const increment = Math.ceil(value / 1000);
  let initialValue = 0;

  const incrementCount = setInterval(() => {
    initialValue += increment;

    if (initialValue > value) {
      element.textContent = value + "+";
      clearInterval(incrementCount);
      return;
    }

    element.textContent = initialValue + "+";
  }, 1);
};

counts.forEach((count) => {
  updateCount(count);
});

const contents = document.querySelectorAll(".container__content");
const testimonialsContainerTransition = document.querySelectorAll(
  ".testimonials__container"
);

const socialMediaLinks = document.querySelectorAll(".social__media-links");
const tabWrapper = document.querySelector(".more-about-us__container");

window.addEventListener("scroll", fadeIn);

function fadeIn() {
  let showNow = window.innerHeight / 1.5;
  contents.forEach((content) => {
    const contentPlace = content.getBoundingClientRect().top;
    if (contentPlace < showNow) content.classList.add("fade-in");
    else content.classList.remove("fade-in");
  });

  const tabPlace = tabWrapper.getBoundingClientRect().top;
  showNow = window.innerHeight / 1.1;
  if (tabPlace < showNow) tabWrapper.classList.add("fade-in");
  else tabWrapper.classList.remove("fade-in");

  testimonialsContainerTransition.forEach((testimony) => {
    const testimonyPlace = testimony.getBoundingClientRect().top;
    showNow = window.innerHeight / 1.2;

    if (testimonyPlace < showNow) testimony.classList.add("fade-in");
    else testimony.classList.remove("fade-in");
  });
  // const testimonialsPlace =
  //   testimonialsContainerTransition.getBoundingClientRect().top;
  // showNow = window.innerHeight / 1.1;
  // if (testimonialsPlace < showNow) {
  //   console.log(testimonialsPlace);
  //   testimonialsContainerTransition.classList.add("fade-in");
  // } else testimonialsContainerTransition.classList.remove("fade-in");

  socialMediaLinks.forEach((link) => {
    const linkPlace = link.getBoundingClientRect().top;
    if (linkPlace < showNow) {
      link.classList.add("fade-in");
    } else {
      link.classList.remove("fade-in");
    }
  });
}

const text = ["Laba Media and Communications"];
const headerTitle = document.querySelector(".header__title");
let characterIndex = 1;

type();
function type() {
  characterIndex++;
  headerTitle.textContent = `${text[0].slice(0, characterIndex)}`;
  // console.log(text[0].slice(0, characterIndex));
  if (characterIndex === text[0].length) {
    return;
  }

  setTimeout(type, 80);
}

//* sliding part
const next = document.querySelector(".next");
const prev = document.querySelector(".prev");
const galleryImgs = document.querySelectorAll(".header__container--img img");
const galleryImgsContainer = document.querySelector(".header__container--img");
const imgHolderSlide = document.querySelector(".header__container--holder");

let currentImg = 0;
let transitionTimeout;

updateSlider();

next.addEventListener("click", function (e) {
  currentImg++;
  clearTimeout(transitionTimeout);
  updateSlider();
});

prev.addEventListener("click", function (e) {
  currentImg--;
  clearTimeout(transitionTimeout);
  updateSlider();
});

function updateSlider() {
  if (currentImg < 0) currentImg = galleryImgs.length - 1;
  else if (currentImg > galleryImgs.length - 1) currentImg = 0;
  let actWidth;
  galleryImgs.forEach((img) => {
    actWidth = img.width + 25;
  });

  galleryImgsContainer.style.transform = `translateX(-${
    currentImg * actWidth
  }px)`;

  transitionTimeout = setTimeout(() => {
    currentImg++;
    updateSlider();
  }, 5000);
}

//* slider ends here

// const activeTabButtons = document.querySelectorAll(".tab-btn");

// activeTabButtons.forEach((btn) => {
//   btn.addEventListener("mouseenter", (e) => {
//     let x = e.pageX - btn.offsetLeft;
//     let y = e.pageY - btn.offsetTop;
//     console.log("x: ", x);
//     console.log("y: ", y);

//     btn.style.setProperty("--xPos", x + "px");
//     btn.style.setProperty("--yPos", y + "px");
//   });
// });

// typer(headerTitle, text, 0);
//  console.log(text[0].length);

// function typer(textElement, array, index) {
//   characterIndex++;
//   let iter = array[index].slice(0, characterIndex);
//   console.log(array[0].slice(0, characterIndex));
//   console.log(iter);
//   return (textElement.textContent = `${array[index].slice(0, characterIndex)}`);
//   console.log(array.slice());

//   textElement.textContent = iter;

//   if (characterIndex >= array[0].length - 1) return;
//   setTimeout(typer, 80);
// }

// heroContainer.addEventListener("mouseleave", (e) => {
//   console.log("leaved");
//   heroContent.forEach((content) => {
//     content.style.transform = `rotateY(0deg) rotateX(0deg)`;
//   });
// });

const cont = document.querySelector(".more-about-us__container");
const hoverArea = document.querySelector(".more-about-us");

let walk = 15;

function shadow(e) {
  const { offsetWidth: width, offsetHeight: height } = hoverArea;

  let { offsetX: x, offsetY: y } = e;
  if (this !== e.target) {
    x = x + e.target.offsetLeft;
    y = y + e.target.offsetTop;
  }

  const xWalk = Math.round((x / width) * walk - walk / 3);
  const yWalk = Math.round((y / height) * walk - walk / 3);
  console.log(xWalk, yWalk);
  cont.style.boxShadow = `${xWalk}px ${yWalk / 8}px ${
    xWalk + yWalk / (1 / yWalk)
  }px 1px var(--clr-blue)`;
}

cont.addEventListener("mousemove", shadow);
