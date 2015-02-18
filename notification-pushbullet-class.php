<?php

require_once(plugin_dir_path( __FILE__ ) . '/vendor/autoload.php');

class DJones_Notification_Pushbullet extends NF_Notification_Base_Type {
    function __construct() {
        $this->name = __( 'Pushbullet', 'ninja-pushbullet-notify' );
    }

    /**
     * Output our edit screen
     *
     * @access public
     * @since 2.8
     * @return void
     */
    public function edit_screen( $id = '' ) {
        $form_id = ( '' != $id ) ? Ninja_Forms()->notification( $id )->form_id : '';

		if ( $id == '' ) {
            $access_token = '';
            $device = "all";
            $title = "Form Submission";
            $message = '';
            $send_url = false;
            $url = admin_url('edit.php?post_type=nf_sub');
        } else {
            $access_token = Ninja_Forms()->notification( $id )->get_setting( 'access_token' );
            $device = Ninja_Forms()->notification( $id )->get_setting( 'device' );
            $title = Ninja_Forms()->notification( $id )->get_setting( 'title' );
            $message = Ninja_Forms()->notification( $id )->get_setting( 'message' );
            $send_url = Ninja_Forms()->notification( $id )->get_setting( 'send_url' );
            $url = Ninja_Forms()->notification( $id )->get_setting( 'url' );
        }

        $p = !empty($access_token) ? new Pushbullet($access_token) : false;
        $devices = $p ? $p->getDevices()->devices : array();

        $all_devices = new stdClass;
        $all_devices->nickname = 'All devices';
        $all_devices->iden = '';
        array_unshift($devices, $all_devices);

        require(plugin_dir_path( __FILE__ ) . 'settings.tpl.php');
    }
}

return new DJones_Notification_Pushbullet();
