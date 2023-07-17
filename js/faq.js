/**
 * Script for the faq
 *
 *
 * @package Canadian_Climate_Conference
 */

// Faq accordion
document.addEventListener("DOMContentLoaded", () => {
  const faqBtns = document.querySelectorAll(".faq-btn");
  faqBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const container = btn.closest(".faq-question-container");
      const answer = container.querySelector(".faq-collapse");
      const faqArrow = container.querySelector(".arrow-faq");

      answer.classList.toggle("active");

      if (answer.classList.contains("active")) {
        answer.style.display = "block";
        answer.style.transition = "transform 0.7s ease";
        faqArrow.style.transform = "rotate(0deg)";
      } else {
        answer.style.display = "none";
        answer.style.transition = "transform 0.7s ease";
        faqArrow.style.transform = "rotate(180deg)";
      }
    });
  });
});
