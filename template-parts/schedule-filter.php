<?php
$event_id = get_the_id(); // Get the ID of the current post
$title = get_the_title();
$industry = get_the_terms(get_the_ID(), 'conference-industry-type');
$description = get_field('event_information');
$time = get_field('start_time');
$speaker_name = get_field('conference-events');

// Format time
$formatted_time = date('g:i A', strtotime($time));

$post_type = get_post_type(); // Get the current post type

// Get all classes related with the CPT ID
$cpt_classes = get_post_class('', $event_id);

// Combines classes grabbed from CPT ID and combines into a single string
$cpt_class_string = implode(' ', $cpt_classes);

?>

<div class="event <?php echo $cpt_class_string; ?>" id="<?php echo $post_type . '-' . $event_id; ?>">
    <!-- <button class="accordion">closed</button>
    <div class="panel"> -->
    <p><b>Start Time:</b> <?php echo $formatted_time; ?></p>
    <h2><?php echo $title; ?></h2>
    <p><b>Industry:</b> <?php echo $industry[0]->name; ?></p>
    <p>Featuring: <?php echo $speaker_name; ?></p>
    <p><?php echo $description; ?></p>
    <!-- </div> -->
    <hr>
</div>

<!-- <script>
    // JavaScript to handle the accordion functionality
    var accordions = document.querySelectorAll(".event");

    accordions.forEach(function(acc) {
        var accordionBtn = acc.querySelector(".accordion");
        var panel = acc.querySelector(".panel");

        accordionBtn.addEventListener("click", function() {
            this.classList.toggle("active");
            panel.classList.toggle("open");

            if (panel.classList.contains("open")) {
                accordionBtn.innerText = "open";
            } else {
                accordionBtn.innerText = "closed";
            }
        });
    });
</script>

<style>
    .accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        transition: 0.4s;
    }

    .active,
    .accordion:hover {
        background-color: #ccc;
    }

    .panel {
        padding: 0 18px;
        display: none;
        background-color: white;
        overflow: hidden;
    }

    .open {
        display: block;
    }
</style> -->