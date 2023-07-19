/**
 * Script for the schedule
 *
 *
 * @package Canadian_Climate_Conference
 */

function filterSchedule() {
  let eventSelected = document.getElementById("event-type");
  let industrySelected = document.getElementById("industry-type");

  let selectedEvent = eventSelected.value;
  let selectedIndustry = industrySelected.value;

  let events = document.getElementsByClassName("conference-events");

  // Display or hide based on selection
  for (let i = 0; i < events.length; i++) {
    let event = events[i];

    // Either conditions need to be met
    // if (
    //   selectedIndustry === "all" ||
    //   event.classList.contains(selectedIndustry)
    // ) {
    //   event.style.display = "block";
    // } else {
    //   event.style.display = "none";
    // }

    // Both conditions need to be met
    if (selectedEvent !== "all" && !event.classList.contains(selectedEvent)) {
      event.style.display = "none";
    }
  }
}

// Day 1/2
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].classList.remove("active");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.classList.add("active");
}

// Accordion
function toggleAccordion(eventId) {
  let panel = document.getElementById(eventId);
  panel.classList.toggle("active");
  let content = panel.querySelector(".panel");
  content.style.display = content.style.display === "none" ? "block" : "none";
  let arrow = panel.querySelector(".arrow");
  arrow.classList.toggle("down");

  // Rotate arrow if active 180 degrees
  if (panel.classList.contains("active")) {
    content.style.display = "block";
    content.style.transition = "transform 0.7s ease";
    arrow.style.transform = "rotate(0deg)";
  } else {
    content.style.display = "none";
    content.style.transition = "transform 0.7s ease";
    arrow.style.transform = "rotate(180deg)";
  }
}
