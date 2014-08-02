<div class="container">
	<form action="<?php echo $this->webroot?>users/login" method="post" class="form-signin">
		<label class="control-label"><?php echo __('Benutzername'); ?>:</label>
		<input type="text" id="user" class="form-control" placeholder="<?php echo __('Benutzername'); ?>" name="data[User][username]" autofocus>
		<br>
		<label class="control-label"><?php echo __('Passwort'); ?>:</label>
		<input type="password" id="pass" class="form-control" placeholder="<?php echo __('Passwort'); ?>" name="data[User][password]" >
		<!--<input type="hidden" id="referer" name="referer" value="<?php echo $origURL; ?>">-->
		<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo __('Einloggen'); ?></button>
		<?php
		if ( Configure::read("general.registration_enabled") ){
			echo '<small>' . $this->Html->link(__('Registrieren'), '/users/register') . '</small>';
		}
		if ( Configure::read("general.allow_lost_password") ){ 
			echo '<small class="pull-right">' . $this->Html->link(__('Passwort vergessen?'), '/users/recover') . '</small>';
		}
		?>
	</form>
</div>
