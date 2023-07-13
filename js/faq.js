// Accordion FAQ

document.addEventListener("DOMContentLoaded", function () {
  var accordionButtons = document.querySelectorAll(".faq-btn");
  accordionButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      var targetCollapse = this.getAttribute("data-target");
      var targetPanel = document.querySelector(targetCollapse);

      // If display block or none based on state
      targetPanel.style.display =
        targetPanel.style.display === "block" ? "" : "block";
      this.setAttribute(
        "aria-expanded",
        targetPanel.style.display === "block" ? "true" : "false"
      );
    });
  });
});
