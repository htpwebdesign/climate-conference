/**
 * Script for the schedule
 *
 *
 * @package Canadian_Climate_Conference
 */

function filterSpeakers() {
    let eventSelected = document.getElementById("event-type");
    let industrySelected = document.getElementById("industry-type");
  
    let selectedEvent = eventSelected.value;
    let selectedIndustry = industrySelected.value;
  
    let events = document.getElementsByClassName("conference-speakers");
  
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
  