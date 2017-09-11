<div class="shouts-widget-container shouts-highlight">
  <div class="shouts-widget-title"><?php __('Shouts');?></div>
  <div class="shouts-widget-detail">
    <?php
    	foreach($shouts as $shout)
    	{ 
    ?>  
    <div class="shouts-widget-detail-row">
      <div class="shouts-widget-detail-row-left"> 
      	<img src="img/user-img2.png" border="0" class="shouts-widget-detail-row-left-img" /> 
      </div>
      <div class="shouts-widget-detail-row-right">
        <table width="448" border="0">
          <tr>
            <th width="314">
              	<?php
              		echo $shout['User']['fullname'];
              	?>
            </th>
            <td width="109">
            	<div class="shouts-widget-detail-date">
              		[ 
              		<?php
              			echo date('M j / g:ia', strtotime($shout['Shout']['created'])); 
              		?>
              		 ] 
            	</div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              	<?php
              		echo $shout['Shout']['shout'];
              	?> 
            </td>
          </tr>
        </table>
      </div>
    </div>
    <?php
    	} 

    	if(empty($shouts))
	    {
	    	echo __('No Shouts.');
	    }
    ?>    
  </div>
  <div class="shouts-widget-action shouts-widget-width-resize">
    <div class="shouts-widget-action-view"> <a href="" class="blueLink">View all</a> </div>
  </div>
</div>
