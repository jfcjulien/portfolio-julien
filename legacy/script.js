const menu = document.querySelector(".fa-bars")
const navLinks = document.querySelector(".nav-links")

menu.addEventListener('click',()=>{
navLinks.classList.toggle('mobile-menu')
})


document.getElementById("contactForm").addEventListener("submit", function(e) {
  e.preventDefault(); // Empêche le rechargement de la page

  const form = e.target;
  const formData = new FormData(form);
  const messageBox = document.getElementById("formMessage");

  // Envoi asynchrone vers contact.php
  fetch("contact.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    // Affiche le message de confirmation du PHP
    messageBox.textContent = data;

    // Style visuel du message
    messageBox.style.color = data.includes("✅") ? "green" : "red";
    messageBox.style.fontWeight = "bold";

    // Réinitialise le formulaire si succès
    if (data.includes("✅")) {
      form.reset();

      // Affiche un pop-up léger
      alert("✅ Message envoyé avec succès !");
    }
  })
  .catch(error => {
    messageBox.textContent = "❌ Une erreur est survenue : " + error;
    messageBox.style.color = "red";
  });
});


document.getElementById("downloadForm").addEventListener("submit", function(e) {
  e.preventDefault(); // Empêche la redirection

  const form = e.target;
  const formData = new FormData(form);
  const messageBox = document.getElementById("downloadMessage");

  fetch("telechargement.php", {
    method: "POST",
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    // Affiche le message renvoyé par PHP
    messageBox.textContent = data;
    messageBox.style.color = data.includes("✅") ? "green" : "red";
    messageBox.style.fontWeight = "bold";

    if (data.includes("✅")) {
      form.reset();

      // Petit pop-up natif
      alert("✅ Les documents ont été envoyés avec succès !");
    }
  })
  .catch(error => {
    messageBox.textContent = "❌ Une erreur est survenue : " + error;
    messageBox.style.color = "red";
  });
});