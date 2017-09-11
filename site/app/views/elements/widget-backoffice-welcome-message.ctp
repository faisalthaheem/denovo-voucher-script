<!-- SITE SETTING START -->
<div class="siteSetting-widget-container">

	<div class="content2-widget-container">
		
		<div class="title">
        	
        	<div class="txt">
        		<?php if($this->params['prefix'] == 'admin'){?>
				
					<?php __('Admin Home');?> &raquo;
					        		
        		<?php }else if($this->params['prefix'] == 'manager'){?>
        		
        			<?php __('Manager Home');?> &raquo;
        		
        		<?php }?>
        	</div>
		
		</div>
		
		<div class="detail">
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
            	<tr>
                	<th colspan="3"> ..:: <?php __('Welcome to DVS Control Panel');?> ::.. </th>
				</tr>
			</table>
		
		</div>
		
		<?php
			if($registration_status == false)
			{
				echo $this->element('widget-backoffice-site-register');
			}else{
				echo $this->element('news');
			}
		?>
	</div>

</div>
<!-- SITE SETTING END -->