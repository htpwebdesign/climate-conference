/**
 * Script for the subscribe form, pressing enter will submit the form on all footer.php templates
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
    document.getElementById('mc4wp-form-1').submit();
  }