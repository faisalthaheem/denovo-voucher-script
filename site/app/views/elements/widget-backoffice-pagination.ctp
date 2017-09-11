<div class="paging">
	<?php echo $paginator->next(__('Next',true) . ' >>', array('class' => 'NextPg'),null, array('class' => 'NextPg DisabledPgLk')); ?>
	<?php echo $paginator->prev('<< ' . __('Previous',true),array('class' => 'PrevPg'),null,array('class' => 'PrevPg DisabledPgLk')); ?>
	<div class="numbers-Div">	
    	<?php echo $paginator->numbers(array('class' => 'numbers', 'separator' => '')); ?>
	</div>
</div>	   				
