<?php

?>
<br/>
<div class="wrap">
    <h1>AT&T Park Virtual Concierge</h1>
    <?php
        $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'sfg_home_button_options';
    ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=sfg_dashboard&tab=sfg_home_button_options" class="nav-tab <?php echo $active_tab == 'sfg_home_button_options' ? 'nav-tab-active' : ''; ?>">Home Page Buttons</a>
        <a href="?page=sfg_dashboard&tab=sfg_advert_options" class="nav-tab <?php echo $active_tab == 'sfg_advert_options' ? 'nav-tab-active' : ''; ?>">Advertisements</a>
        <a href="?page=sfg_dashboard&tab=sfg_concessions_options" class="nav-tab <?php echo $active_tab == 'sfg_concessions_options' ? 'nav-tab-active' : ''; ?>">Concessions Menus</a>
        <a href="?page=sfg_dashboard&tab=sfg_tv_guide_options" class="nav-tab <?php echo $active_tab == 'sfg_tv_guide_options' ? 'nav-tab-active' : ''; ?>">Tv Guide</a>
        <a href="?page=sfg_dashboard&tab=sfg_maps_options" class="nav-tab <?php echo $active_tab == 'sfg_maps_options' ? 'nav-tab-active' : ''; ?>">Maps</a>
        <a href="?page=sfg_dashboard&tab=sfg_stats_options" class="nav-tab <?php echo $active_tab == 'sfg_stats_options' ? 'nav-tab-active' : ''; ?>">Statistics</a>
        <a href="?page=sfg_dashboard&tab=sfg_schedule_options" class="nav-tab <?php echo $active_tab == 'sfg_schedule_options' ? 'nav-tab-active' : ''; ?>">Schedule</a>
        <a href="?page=sfg_dashboard&tab=sfg_logo_options" class="nav-tab <?php echo $active_tab == 'sfg_logo_options' ? 'nav-tab-active' : ''; ?>">Change Logo Image</a>
    </h2>

    <form method="post" action="options.php">
		<?php

        if ( $active_tab == 'sfg_home_button_options' ) {
	        settings_fields( 'sfg_home_button_options' );
	        do_settings_sections( 'sfg_home_button_options' );
        }

        if ( $active_tab == 'sfg_advert_options' ) {
	        settings_fields( 'sfg_advert_options' );
	        do_settings_sections( 'sfg_advert_options' );
        }

        if ( $active_tab == 'sfg_concessions_options' ) {
	        settings_fields( 'sfg_concessions_options' );
	        do_settings_sections( 'sfg_concessions_options' );
        }

        if ( $active_tab == 'sfg_tv_guide_options' ) {
	        settings_fields( 'sfg_tv_guide_options' );
	        do_settings_sections( 'sfg_tv_guide_options' );
        }

        if ( $active_tab == 'sfg_maps_options' ) {
	        settings_fields( 'sfg_maps_options' );
	        do_settings_sections( 'sfg_maps_options' );
        }

        if ( $active_tab == 'sfg_stats_options' ) {
	        settings_fields( 'sfg_stats_options' );
	        do_settings_sections( 'sfg_stats_options' );
        }

        if ( $active_tab == 'sfg_schedule_options' ) {
	        settings_fields( 'sfg_schedule_options' );
	        do_settings_sections( 'sfg_schedule_options' );
        }

        if ( $active_tab == 'sfg_logo_options' ) {
	        settings_fields( 'sfg_logo_options' );
	        do_settings_sections( 'sfg_logo_options' );
        }








		submit_button();
		?>
    </form>













</div>
