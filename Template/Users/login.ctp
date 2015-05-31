<div class="container">
    <?php
    use Cake\Core\Configure;
    echo $this->Form->create($user);
    echo $this->Form->input('username', [ 'label' => __('Benutzername'), 'placeholder' => __('Benutzername') ] );
    echo $this->Form->input('password', [ 'label' => __('Passwort'), 'placeholder' => __('Passwort') ] );
    echo $this->Form->submit(__('Einloggen'));
    if ( Configure::read("general.registration_enabled") ){
        echo '<small>' . $this->Html->link(__('Registrieren'), '/users/register') . '</small>';
    }
    if ( Configure::read("general.allow_lost_password") ){ 
            echo '<small class="pull-right">' . $this->Html->link(__('Passwort vergessen?'), '/users/recover') . '</small>';
    }
    echo $this->Form->end();
    ?>
</div>
