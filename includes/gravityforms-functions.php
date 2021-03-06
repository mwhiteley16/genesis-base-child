<?php
/**
 * Gravity Forms Domain
 *
 * Adds a notice at the end of admin email notifications
 * specifying the domain from which the email was sent.
 *
 * @param array $notification
 * @param object $form
 * @param object $entry
 * @return array $notification
 */
function wd_gravityforms_domain( $notification, $form, $entry ) {
	if( $notification['name'] == 'Admin Notification' ) {
		$notification['message'] .= 'Sent from ' . home_url();
	}
	return $notification;
}
add_filter( 'gform_notification', 'wd_gravityforms_domain', 10, 3 );

/**
 * Gravity Forms Title Visibility
 *
 * Adds option to hide title when creating form fields
 *
 */
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
