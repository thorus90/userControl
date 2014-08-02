<?php
$inputoptions = array(
	'class' => 'form-control input-lg',
	'required' => 'true',
	'label' => ''
);
?>
<div class="container">
	<?php echo $this->element('messages'); ?>
	<?php echo $this->Form->create('Users', array('action' => 'setNewPassword')); ?>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Benutzername:"); ?></span>
			<?php echo $this->Form->input('User.username', array
				(
					'label' => '',
					'class' => 'form-control input-lg',
					'disabled' => 'disabled',
					'value' => $username
				)
			); ?>
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort:"); ?></span>
			<?php echo $this->Form->input('User.password', array
				(
					'label' => '',
					'class' => 'form-control input-lg'
				)
			); ?>
		</div>
		<div class="input-group input-group-lg">
			<span class="input-group-addon"><?php echo __("Passwort wiederholen:"); ?></span>
			<?php echo $this->Form->input('User.pwsame', array
				(
					'label' => '',
					'class' => 'form-control input-lg',
					'type' => 'password'
				)
			); ?>
		</div>
		<?php 
		echo $this->Form->input('User.id',array('type' => 'hidden','value' => $id)); 
		echo $this->Form->input('User.resetkey',array('type' => 'hidden','value' => $resetkey)); 
		echo $this->Form->button(__('Passwort setzen'), array(
			'class' => 'btn btn-default submit',
			'type' => 'submit')
		);
	echo $this->Form->end(); ?>
</div>
