<div class="important-notification-widget-container important-notification-highlight" id="important-notification-dashboard-widget-container">
    <div class="important-notification-widget-title"><?php __('Important Notifications');?></div>
    <div class="important-notification-widget-detail">
    <?php
    	foreach($notifications as $notification){ 
    ?>
        <div class="important-notification-widget-detail-row">
          <table width="498" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <th width="248"><?php echo $notification['Notification']['title']; ?></th>
              <td width="250">
              	<div class="important-notification-widget-date">
              		[ 
              		<?php
              			echo date('M j / g:ia', strtotime($notification['Notification']['modified'])); 
              		?>
              		 ]
              	</div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
              	<?php
              		echo $notification['Notification']['description'];
              	?> 
              </td>
            </tr>
          </table>
        </div>
    <?php
    	} 

    	if(empty($notifications))
	    {
	    	echo __('No notifications.');
	    }
    ?>
    </div>
</div>
