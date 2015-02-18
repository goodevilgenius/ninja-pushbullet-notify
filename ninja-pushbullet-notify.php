<?php
/**
 * Plugin Name: Ninja Pushbullet Notify
 * Plugin URI: https://localhost/
 * Description: Add Pushbullet Notifications to Ninja Forms for free
 * Version: 0.0.1
 * Author: Dan Jones
 * Author URI: http://danielrayjones.com/
 * License: MIT
 */

/**
 * Class for our email notification type.
 *
 * @copyright   Copyright (c) 2014, Dan Jones
 * @license     MIT
 * @since       2.8
*/

function add_ninja_pushbullet_notify($types) {
    $types['pushbullet'] = require_once(plugin_dir_path( __FILE__ ) . "notification-pushbullet-class.php");
    return $types;
}
add_filter('nf_notification_types', 'add_ninja_pushbullet_notify');
