<?php

/**
 * Trigger this file on Plugin uninstall
 * @package  SSBrunoCodeBoil
 */


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}
$options = get_option( 'toptal_breaking_news' );
delete_post_meta( $options['breaking-news-post_id'], 'toptal-breaking-news' );
delete_post_meta( $options['breaking-news-post_id'], 'toptal-time-period' );
delete_post_meta( $options['breaking-news-post_id'], 'toptal-datetime' );
delete_post_meta( $options['breaking-news-post_id'], 'toptal-breaking-news-title' );
delete_option( 'toptal_breaking_news' );
delete_option( 'toptal_bnp_plugin' );
