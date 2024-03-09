const testimonialsContainer = document.querySelector(".testimonials");
let timeout;

document
  .querySelector(".testimonials-button.next-testimonials")
  .addEventListener("click", (e) => {
    clearTimeout(timeout);
    startSlider();
  });
document
  .querySelector(".testimonials-button.prev-testimonials")
  .addEventListener("click", (e) => {
    clearTimeout(timeout);
    startSlider("prev-testimonial");
  });

function startSlider(type) {
  const active = document.querySelector(".active-testimonial");
  const last = document.querySelector(".last-testimonial");
  let next = active.nextElementSibling;
  if (!next) next = testimonialsContainer.firstElementChild;

  active.classList.remove("active-testimonial");
  last.classList.remove("last-testimonial");
  next.classList.remove("next-testimonial");

  if (type === "prev-testimonial") {
    active.classList.add("next-testimonial");
    last.classList.add("active-testimonial");
    next = last.previousElementSibling;
    if (!next) next = testimonialsContainer.lastElementChild;
    next.classList.remove("next-testimonial");
    next.classList.add("last-testimonial");
    timeout = setTimeout(() => {
      startSlider();
    }, 5000);
    return;
  }

  active.classList.add("last-testimonial");
  last.classList.add("next-testimonial");
  next.classList.add("active-testimonial");
  timeout = setTimeout(() => {
    startSlider();
  }, 5000);
}

startSlider();

const testimonialTop = testimonialsContainer.getBoundingClientRect().top + 10;

// window.addEventListener("scroll", slideThere);

// function slideThere() {
//   console.log("test top: ", testimonialTop);
//   clearTimeout(timeout);
//   console.log(window.innerHeight / 2);
//   if (testimonialTop <= window.scrollY) {
//     startSlider();
//   } else {
//     clearTimeout(timeout);
//     return;
//   }
// }
