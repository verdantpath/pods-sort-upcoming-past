<?php
/*
Template Name: Webinar Grid
*/

$todays_date = date('Y-m-d');

// get current item
$slug = pods_v( 'last', 'url' );
// get pods object for current item
$pods = pods( 'webinar', $slug );

$webinar_title = $pods->display('webinar_title');
$webinar_date = $pods->display('webinar_date');

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content" data-test="testtest">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

			<div class="savequeries-container">
				<?php
					// if ( current_user_can( 'manage_options' ) ) {
					// 	global $wpdb;
					// 	print_r( $wpdb->queries );
					// } 
				?>
			</div>

<?php endif; ?>

<?php
$params_upcoming = array(
    'limit' => 4,
    // Be sure to sanitize ANY strings going here
    'where'=>"webinar_date.meta_value >= '$todays_date'"
);

// Run the find
$mypod = pods( 'webinar', $params_upcoming );
echo '<h3>Upcoming</h3>';
// Loop through the records returned and return upcoming results
while ( $mypod->fetch() ) {


    echo '<ul><li><a href="' . $mypod->display( 'permalink' ) . '">' . $mypod->display( 'webinar_title' ) . "</a></li>";
    echo '<li>' . $mypod->display( 'webinar_date' ) . '</li></ul>';
}

$params_past = array(
    'limit' => 4,
    // Be sure to sanitize ANY strings going here
    'where'=>"webinar_date.meta_value < '$todays_date'"
);

// Run the find
$mypod = pods( 'webinar', $params_past );
echo '<h3>Past</h3>';
// Loop through the records returned and return upcoming results
while ( $mypod->fetch() ) {


    echo '<ul><li><a href="' . $mypod->display( 'permalink' ) . '">' . $mypod->display( 'webinar_title' ) . "</a></li>";
    echo '<li>' . $mypod->display( 'webinar_date' ) . '</li></ul>';
}
?>




<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>
