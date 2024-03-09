const form = document.querySelector("form");
const statusText = form.querySelector(".warning");

form.onsubmit = (e) => {
  e.preventDefault();
  statusText.textContent = "Sending your message...";
  form.classList.add("disabled");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./reach_us.php", true);
  xhr.onload = () => {
    if (xhr.readyState == 4 && xhr.status == 200) {
      let response = xhr.response;
      if (
        response.indexOf("required") != -1 ||
        response.indexOf("valid") != -1 ||
        response.indexOf("failed") != -1
      ) {
        statusText.style.color = "indianred";
      } else {
        form.reset();
        setTimeout(() => {
          statusText.style.display = "none";
        }, 4500);
      }
      statusText.textContent = response;
      form.classList.remove("disabled");
    }
  };

  let formData = new FormData(form);
  xhr.send(formData);
};
