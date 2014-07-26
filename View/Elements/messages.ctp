<div id="messages">
<?php
	if ( isset($messages) )
	{
		foreach ($messages as $message)
		{
			echo '<div class="alert ';
			if ( $message['ret'] == 0 ) {
				echo "alert-success";
			}
			if ( $message['ret'] == 1 ) {
				echo "alert-warning";
			}
			if ( $message['ret'] == 2 ) {
				echo "alert-danger";
			}
			if ( $message['ret'] == 3 ) {
				echo "alert-info";
			}
			echo '">';
			echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			foreach ($message['message'] as $reason => $text) {
				echo '<p>' . $text[0] . '</p>';
			}
			echo '</div>';
		}
	}
?>
</div>