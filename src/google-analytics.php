<?php
/**
 * Initialize Google Analytics package.
 *
 * @package automattic/jetpack-google-analytics
 */

use Automattic\Jetpack\Google_Analytics\GA_Manager;

global $jetpack_google_analytics;
$jetpack_google_analytics = GA_Manager::get_instance();
