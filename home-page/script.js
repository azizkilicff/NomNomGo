/* Mobile Navbar Toggle */
const menuOpenButton = document.querySelector("#menu-open-button");
const menuCloseButton = document.querySelector("#menu-close-button");
const navMenu = document.querySelector(".nav-menu");

if (menuOpenButton && menuCloseButton && navMenu) {
  menuOpenButton.addEventListener("click", () => {
    navMenu.classList.add("active");
  });

  menuCloseButton.addEventListener("click", () => {
    navMenu.classList.remove("active");
  });

  // Close menu when a nav link is clicked (for mobile)
  document.querySelectorAll(".nav-link").forEach(link => {
    link.addEventListener("click", () => {
      navMenu.classList.remove("active");
    });
  });

  // Smooth Scrolling for Menu Links
  document.querySelectorAll(".nav-link").forEach(anchor => {
    anchor.addEventListener("click", function (event) {
      const targetId = this.getAttribute("href");
      if (targetId.startsWith("#")) {
        event.preventDefault();
        const targetElement = document.getElementById(targetId.substring(1));
        if (targetElement) {
          targetElement.scrollIntoView({ behavior: "smooth" });
        }
      }
    });
  });
  
}

/* Animate Elements on Scroll */
const sections = document.querySelectorAll("section");
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    }
  });
}, { threshold: 0.3 });

sections.forEach(section => {
  observer.observe(section);
});

/* Add fade-in animation to menu items */
document.querySelectorAll(".menu-item").forEach((item, index) => {
  setTimeout(() => {
    item.classList.add("fade-in");
  }, index * 200);
});

/* Contact Form Submission */
const contactForm = document.querySelector(".contact-form");
if (contactForm) {
  contactForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent actual form submission
    alert("Thank you for contacting NomNomGo! We will get back to you soon.");
    this.reset(); // Reset the form fields
  });
}


// Initialize Swiper for the Menu Section
var menuSwiper = new Swiper('.menu-swiper', {
  slidesPerView: 1,
  spaceBetween: 20,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
