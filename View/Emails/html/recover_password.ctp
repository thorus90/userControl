<p><?php echo __('Bitte klicken Sie auf den unten stehenden Link um Ihr Passwort zurücksetzen'); ?></p>
<a href="https://<?php echo $_SERVER['HTTP_HOST']; ?>/reset/<?php echo $key . 'BXX' . $rand . 'XXB' . $id ?>/">
	<?php echo __('Hier klicken um Passwort zurückzusetzen'); ?>
</a>
<hr />
<p><?php echo __('Alternativ kopieren Sie diesen Link in Ihren Browser'); ?>:
</p>
<p>https://<?php echo $_SERVER['HTTP_HOST']; ?>/reset/<?php echo $key . 'BXX' . $rand . 'XXB' . $id ?>/</p>
<p><?php echo __('Diese Mail wurde von der Anwendung ') . Configure::read("general.appname") . __(' verschickt'); ?>.</p>