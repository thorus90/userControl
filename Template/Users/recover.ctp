<div class="container">
	<?php 
    echo $this->Form->create(null);
    echo $this->Form->input('email', [ 'label' => __("E-Mail Adresse:") ] );
    echo $this->Form->submit(__("Abschicken"), [ 'id' => 'register_submit' ] );
    echo $this->Form->end();
    ?>
</div>
