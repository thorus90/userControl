<div class="container">
    <?php
        echo $this->Form->create('User');
        echo $this->Form->input('User.id', array('hiddenField' => true,'value' => $id));
        echo $this->Form->input('User.email', array('label' => 'E-Mail', 'value' => $email));
        echo $this->Form->input('User.password');
        echo $this->Form->input('User.password_confirm', array('label' => __('Confirm Password'), 'type' => 'password'));
        echo $this->Form->end(__('Submit'));
    ?>
</div>
