<?php if(isset($error) && $error): ?>

	<?php __('There was an error sending your message. Please');?> 
	<?php
		echo $this->Js->link(
			__('try again.',true)
			,'/conversations/new_conversation'
			,array(
				'update' => '#mid-container-left-panel'
			)
		);  
	?>

<?php else: ?>

	<?php __('Your message was sent successfully');?>, 
	<?php
		echo $this->Js->link(
			__('send another.',true)
			,'/conversations/new_conversation'
			,array(
				'update' => '#mid-container-left-panel'
			)
		);  
	?>

<?php endif;?>

<?php
	echo $this->Js->writeBuffer(); 
?>