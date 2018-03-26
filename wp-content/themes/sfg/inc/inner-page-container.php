<?php

$logo_options = get_option( 'sfg_logo_options');

?>

<div class="container-fluid" style="padding-left:0px; padding-right:0px;">
	<div class="container-fluid inner-page-container" style="background-image:url('<?php echo sfg_background_image(); ?>')">
        <div class="row inner-page inner-page-active" href="#" id="page-food-beverage">
			<?php require( 'food-beverage.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-tv-guide">
			<?php require( 'tv-guide.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-maps">
			<?php require( 'maps.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-contact-concierge">
			<?php require( 'contact-concierge.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-request-photog">
			<?php require( 'request-photog.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-giants-az">
			<?php require( 'giants-az.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-stats">
			<?php require( 'stats.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-events">
			<?php require( 'events.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-feedback">
			<?php require( 'feedback.php' ); ?>
        </div>
        <div class="row inner-page" href="#" id="page-browse">
			<?php require( 'browse.php' ); ?>
        </div>
		<div class="inner-page-buttons">
			<a class="inner-button inner-button-active" href="#" id="food-beverage">
				<span><h5>Food & Beverage</h5></span>
			</a><a class="inner-button" href="#" id="tv-guide">
				<span><h5>TV Guide</h5></span>
			</a><a class="inner-button" href="#" id="maps">
				<span><h5>Maps</h5></span>
			</a><a class="inner-button" href="#" id="contact-concierge">
				<span><h5>Contact Concierge</h5></span>
			</a><a class="inner-button" href="#" id="request-photog">
				<span><h5>Request Photographer</h5></span>
			</a><a class="inner-button" href="#" id="giants-az">
				<span><h5>Giants A-Z</h5></span>
			</a><a class="inner-button" href="#" id="stats">
				<span><h5>Stats & Notes</h5></span>
			</a><a class="inner-button" href="#" id="events">
				<span><h5>Events Schedule</h5></span>
			</a><a class="inner-button" href="#" id="feedback">
				<span><h5>Leave Feedback</h5></span>
			</a><a class="inner-button" href="#" id="browse">
				<span><h5>Browse Internet</h5></span>
			</a>
		</div>
	</div>
</div>