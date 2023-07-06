<?php
$title = get_the_title();
$industry = get_the_terms(get_the_ID(), 'conference-industry-type');
$description = get_field('event_information');
$time = get_field('start_time');
$speaker_name = get_field('conference-events');

// Format time 
$formatted_time = date('g:i A', strtotime($time));
?>

<div class="event">
    <p><b>Start Time:</b> <?php echo $formatted_time; ?></p>
    <h2><?php echo $title; ?></h2>
    <p><b>Industry:</b> <?php echo $industry[0]->name; ?></p>
    <p>Featuring: <?php echo $speaker_name; ?></p>
    <p><?php echo $description; ?></p>
</div>