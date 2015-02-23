<?php

require_once(plugin_dir_path( __FILE__ ) . '/vendor/autoload.php');

class NF_DJ_Notification_Pushbullet extends NF_Notification_Base_Type {
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
            $push_device = "";
            $push_type = "note";
            $push_title = "";
            $push_url = '';
            $push_message = '';
        } else {
            $access_token = Ninja_Forms()->notification( $id )->get_setting( 'access_token' );
            $push_message = Ninja_Forms()->notification( $id )->get_setting( 'push_message' );
            $push_type = Ninja_Forms()->notification( $id )->get_setting( 'push_type' );
            $push_title = Ninja_Forms()->notification( $id )->get_setting( 'push_title' );
            $push_url = Ninja_Forms()->notification( $id )->get_setting( 'push_url' );
            $push_device = Ninja_Forms()->notification( $id )->get_setting( 'push_device' );
        }

        $p = !empty($access_token) ? new Pushbullet($access_token) : false;
        $push_devices = $p ? $p->getDevices()->devices : array();
        $pushtypes = array('note','link');


        $all_devices = new stdClass;
        $all_devices->nickname = 'All devices';
        $all_devices->iden = '';
        array_unshift($push_devices, $all_devices);

        require(plugin_dir_path( __FILE__ ) . 'settings.tpl.php');

		do_action( 'nf_dj_pushbullet_notification_after_settings', $id );
    }

	/**
	 * Process our Push notification
	 *
	 * @access public
	 * @since 2.8
	 * @return void
	 */
	public function process( $id ) {
		$access_token = Ninja_Forms()->notification( $id )->get_setting( 'access_token' );
        if (empty($access_token)) {
            file_put_contents('/tmp/notifications-pushbullet-class.log', "Empty access token\n", FILE_APPEND);
            return;
        }
        $form_id = ( '' != $id ) ? Ninja_Forms()->notification( $id )->form_id : '';
        $push_type = Ninja_Forms()->notification( $id )->get_setting( 'push_type' );
        $push_title = $this->process_setting( $id, 'push_title' );
        $push_url = Ninja_Forms()->notification( $id )->get_setting( 'push_url' );
        $push_message = $this->process_setting( $id, 'push_message' );
        $push_device = Ninja_Forms()->notification( $id )->get_setting( 'push_device' );
        if (empty($push_url)) $push_url = admin_url('edit.php?post_status=all&post_type=nf_sub&form_id=' . $form_id);

        $p = new Pushbullet($access_token);

        try {
            if ($push_type == "note") {
                $p->pushNote($push_device, $push_title, $push_message);
            } else if ($push_type == "link") {
                $p->pushLink($push_device, $push_title, $push_url, $push_message);
            }
        } catch (PushbulletException $e) {
            return;
        }
    }

	/**
	 * Explode our settings by ` and extract each value.
	 * Check to see if the setting is a field; if it is, assign the value.
	 * Run shortcodes and return the result.
	 *
	 * @access public
	 * @since 2.8
	 * @return array $setting
	 */
	public function process_setting( $id, $setting, $html = 1 ) {
        return implode(' ', parent::process_setting($id, $setting, $html));
    }
}

return new NF_DJ_Notification_Pushbullet();
