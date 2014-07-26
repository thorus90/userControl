<div class="container">
	<?php echo $this->element('messages'); ?>
	<form action="/user/recover" method="post">
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("E-Mail Adresse:"); ?></span>
			<input class="form-control input-lg" type="email" name="email">
		</div>
		<button class="btn btn-default submit" type="submit" id="register_submit">
			<?php echo __("Abschicken"); ?>
		</button>
	</form>
</div>
