<?php
/**
 * Plugin Name: Pushbullet Notify for Ninja Forms
 * Plugin URI: https://github.com/goodevilgenius/ninja-pushbullet-notify/
 * Description: Add Pushbullet Notifications to Ninja Forms
 * Version: 0.0.2
 * Author: Dan Jones
 * Author URI: http://danielrayjones.com/
 * License: MIT
 */

function add_ninja_pushbullet_notify($types) {
    $types['pushbullet'] = require_once(plugin_dir_path( __FILE__ ) . "notification-pushbullet-class.php");
    return $types;
}
add_filter('nf_notification_types', 'add_ninja_pushbullet_notify');
