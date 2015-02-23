<tr>
  <th scope="row"><label for="settings-access_token"><?php _e( 'Access Token', 'ninja-pushbullet-notify' ); ?></label></th>
  <td>
	<input name="settings[access_token]" type="text" id="settings-access_token" value="<?php echo $access_token; ?>" />
	<span class="howto"><?php _e( 'Your access token can be found on your <a href="https://www.pushbullet.com/account">Account Settings</a> page.', 'ninja-pushbullet-notify' ) ?></span>
  </td>
</tr>

<tr>
  <th scope="row"><label for="settings-push_device"><?php _e('Device', 'ninja-pushbullet-notify'); ?></label></th>
  <td>
	<select name="settings[push_device]" id="settings-push_device">
	  <?php foreach($push_devices as $dev): ?>
	  <?php $sel = ($push_device == $dev->iden); ?>
	  <option value="<?= $dev->iden?>" <?= $sel?'selected="selected"':''?>><?= $dev->nickname?></option>
	  <?php endforeach; ?>
	</select>
  </td>
</tr>

<tr>
  <th scope="row"><?php _e('Push type', 'ninja-pushbullet-notify'); ?></th>
  <td>
	<?php foreach($pushtypes as $ptype): ?>
	<?php $sel = ($ptype == $push_type); ?>
	<p>
	  <input type="radio" name="settings[push_type]" value="<?=$ptype?>" id="settings-push_type-<?=$ptype?>" 
			 <?= $sel?'checked="checked"':''?>
			 /> 
	  <label for="settings-push_type-<?=$ptype?>"><?=ucfirst($ptype)?></label>
	</p>
	<?php endforeach; ?>
  </td>
</tr>

<tr>
  <th scope="row"><label for="settings-push_title">Title</label></th>
  <td>
	<input name="settings[push_title]" type="text" id="settings-push_title" value="<?php echo $push_title; ?>" class="nf-tokenize" placeholder="<?php _e( 'Push Title or search for a field', 'ninja-pushbullet-notify' ); ?>" data-token-limit="0" data-key="push_title" data-type="all" value="<?=$push_title?>" />
	<span class="howto"><?php _e( 'This will be the title of the push.', 'ninja-pushbullet-notify' ); ?></span>
  </td>
</tr>

<tr>
  <th scope="row"><label for="settings-push_message"><?php _e( 'Body', 'ninja-pushbullet-notify' ); ?></label></th>
  <td>
	<?php
	   $settings = array(
	     'textarea_name' => 'settings[push_message]',
	   );
	   wp_editor( $push_message, 'push_message', $settings );
	?>
  </td>
</tr>
