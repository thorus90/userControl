<div id="messages">
<?php
	if ( isset($this->validationErrors) )
	{
		foreach ($this->validationErrors as $messageCategory)
		{
			foreach ($messageCategory as $message)
			{
				echo '<div class="alert alert-danger"><p>' . $message[0] . '</p>';
				echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
				echo '</div>';
			}
		}
	}
?>
</div>
