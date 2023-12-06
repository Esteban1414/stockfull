const btn = document.querySelector("#btn");
const feedback = document.querySelector("#feedback");
const alert = document.querySelector(".alert");
const fields = document.querySelectorAll(".validate");

function validate(errors) {
  fields.forEach(function (field) {
    if (field.value == "") {
      field.classList.add("errorField");
      errors.push(field.id);
    }
  });
}
function message(message) {
  alert.style.display = "block";
  feedback.innerHTML = message;
  setTimeout(function () {
    alert.style.display = "none";
    fields.forEach(function (field) {
      field.classList.remove("errorField");
    });
  }, 3000);
}

btn.addEventListener("click", async function (event) {
  let errors = [];
  event.preventDefault();
  feedback.innerHTML = ``;
  validate(errors);
  if (errors.length > 0) {
    message(`The field ${errors.toString()} can not be empty`);
    return false;
  }
 const formData = new FormData(document.getElementById("login"));

 try {
     const response = await fetch("./validate.php", {
         method: "POST",
         body: formData
     });
     const data = await response.json();
     if (data.success) {
         window.location.href = "../admin/";
     } else {
         message(data.message);
     }
 } catch (error) {
     console.error("Error making AJAX request:", error);
     message("An error occurred. Please try again later.");
 }
});