<div class="news-widget-container news-highlight">
    <div class="news-widget-title"><?php __('News');?></div>
      <div class="news-widget-detail">
      <?php
      	foreach($news as $newsitem)
      	{ 
      ?>
          <div class="news-widget-detail-row">
            <table width="498" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <th width="248"><?php echo $newsitem['News']['title']; ?></th>
	              <td width="250">
	              	<div class="news-widget-date">
	              		[ 
	              		<?php
	              			echo date('M j / g:ia', strtotime($newsitem['News']['modified'])); 
	              		?>
	              		 ]
	              	</div>
	              </td>
              </tr>
              <tr>
                <td colspan="2">
	              	<?php
	              		echo $newsitem['News']['description'];
	              	?> 
              </tr>
            </table>
          </div>
    <?php
    	} 

    	if(empty($news))
	    {
	    	echo __('No News.');
	    }
    ?>
    </div>
</div>
