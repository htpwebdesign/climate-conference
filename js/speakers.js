
    function filterSpeakers() {
        var selectedIndustry = document.getElementById('industry-type').value;
        var speakers = document.getElementsByClassName('single-speaker');

        for (var i = 0; i < speakers.length; i++) {
            var speaker = speakers[i];
            var industry = speaker.getAttribute('data-industry');

            if (selectedIndustry === 'all' || selectedIndustry === industry) {
                speaker.style.display = 'block';
            } else {
                speaker.style.display = 'none';
            }
        }
    }


