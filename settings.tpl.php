<tr>
  <th scope="row"><label for="settings-access_token"><?php _e( 'Access Token', 'ninja-pushbullet-notify' ); ?></label></th>
  <td>
	<input name="settings[access_token]" type="text" id="settings-access_token" value="<?php echo $access_token; ?>" />
	<span class="howto"><?php _e( 'Your access token can be found on your <a href="https://www.pushbullet.com/account">Account Settings</a> page.', 'ninja-pushbullet-notify' ) ?></span>
  </td>
</tr>

<tr>
  <th scope="row"><label for="settings-device"><?php _e('Device', 'ninja-pushbullet-notify'); ?></label></th>
  <td>
	<select name="settings[device]" id="settings-device">
	  <?php foreach($devices as $dev): ?>
	  <option value="<?= $dev->iden?>"><?= $dev->nickname?></option>
	  <?php endforeach; ?>
	</select>
  </td>
</tr>
