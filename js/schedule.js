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
    if (
      selectedIndustry === "all" ||
      event.classList.contains(selectedIndustry)
    ) {
      event.style.display = "block";
    } else {
      event.style.display = "none";
    }

    // Both conditions need to be met
    if (selectedEvent !== "all" && !event.classList.contains(selectedEvent)) {
      event.style.display = "none";
    }
  }
}

// For day 1 / 2 tabs
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
