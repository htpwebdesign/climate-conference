/**
 * Script for the subscribe form, pressing enter will submit the form
 *
 *
 * @package Canadian_Climate_Conference
 */


function handleKeyDown(event) {
    if (event.keyCode === 13) { 
      event.preventDefault(); 
      submitForm();
    }
  }

  function submitForm() {
    var input = document.getElementById('subscribeForm').value;
    console.log('Submitted:', input);
  }