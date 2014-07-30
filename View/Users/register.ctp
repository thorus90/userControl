<?php 
//echo $this->Html->script(Configure::read('App.jsBaseUrl') . 'user' . DS . 'register.js'); 
echo $this->Html->script('/js/' . 'user' . DS . 'register.js'); 
?>
<div class="container">
	<?php echo $this->element('messages'); ?>
	<form action="<?php echo $this->webroot; ?>users/register" method="post">
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Benutzername:"); ?></span>
			<input class="form-control input-lg" <?php if(isset($post)) echo 'value="' . $post['user'] . '" ' ?> type="user" name="username">
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("E-Mail Adresse:"); ?></span>
			<input class="form-control input-lg" <?php if(isset($post)) echo 'value="' . $post['email'] . '" ' ?> type="user" name="email">
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort:"); ?></span>
			<input class="form-control input-lg" type="password" <?php if(isset($post)) echo 'value="' . $post['password'] . '" ' ?> name="password">
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort wiederholen:"); ?></span>
			<input class="form-control input-lg" type="password" <?php if(isset($post)) echo 'value="' . $post['pwsame'] . '" ' ?> name="pwsame">
		</div>
		<div class="input-group input-group-lg">
			<div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php echo __("Sprache"); ?> <span class="caret"></span></button>
				<ul class="dropdown-menu">
				<?php
				foreach (glob(ROOT . DS . APP_DIR . DS . 'Locale' . DS . '*', GLOB_ONLYDIR) as $langPath)
				{
					$lang = explode (DS, $langPath);
					echo '<li><a class="select_lang" href="#">' . array_pop($lang) . '</a></li>';
				}
				?>
				</ul>
			</div>
			<input class="form-control input-lg" type="text" <?php if(isset($post)) echo 'value="' . $post['language'] . '" ' ?> id="language" disabled>
			<input class="form-control input-lg" type="hidden" <?php if(isset($post)) echo 'value="' . $post['language'] . '" ' ?> name="language" id="language-real">
		</div>
		<button class="btn btn-default submit" type="submit" id="register_submit">
				<?php echo __("Abschicken"); ?>
		</button>
	</form>
</div>
