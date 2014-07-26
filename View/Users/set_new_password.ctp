<div class="container">
	<?php echo $this->element('messages'); ?>
	<form action="/user/setNewPassword" method="post">
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort:"); ?></span>
			<input class="form-control input-lg" type="password" name="password">
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort wiederholen:"); ?></span>
			<input class="form-control input-lg" type="password" name="pwsame">
		</div>
		<input type="hidden" name="id" value="<?php if( isset($id) ) { echo $id; } ?>">
		<input type="hidden" name="resetkey" value="<?php if( isset($id) ) { echo $resetkey; } ?>">
		<button class="btn btn-default submit" type="submit">
			<?php echo __("Abschicken"); ?>
		</button>
	</form>
</div>