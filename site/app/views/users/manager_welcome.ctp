	<!-- MID CONTAINER START -->
    <div class="mid-container">

        <!-- SITE SETTTING START -->
        <div class="siteSetting-widget-container">
            
            <div class="content1-widget-container">
                
                <div class="title">
                    <div class="txt">Site Setting &raquo;</div>
                </div>
                
                <div class="detail">
                    <div class="left">
                        <li class="active">Site Logos</li>
                        <li>Site Urls</li>
                        <li>Site Banners</li>
                    </div>
                    
                    <div class="right">
                        
                        <div class="description1">
                            Site Logo Description dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                             dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type 
                             specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                             essentially unchanged.
                        </div>
                        
                        <div class="description2">
                            Site Url Descriptions dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                             dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type 
                             specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                             essentially unchanged.
                             Lorem Ipsum 2 simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                             dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type 
                             specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                             essentially unchanged.
                        </div>
                        
                        <div class="description3">
                            Banner Description dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                             dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type 
                             specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining 
                             essentially unchanged.
                             Lorem Ipsum 2 simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard
                             dummy text ever since.
                        </div>
                    
                    </div>
                
                </div>
            
            </div>

			<div class="content2-widget-container">
            	
            	<div class="title">
                    <div class="txt">Site Urls &raquo;</div>
                </div>
                
                <div class="detail">
                	<form>
                	<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
                      <tr>
                        <th colspan="3">Welcome to Settings Management Section. Please Manage Following Setting.</th>
                      </tr>
                      <tr>
                        <td colspan="3"></td>
                      </tr>
                      <tr>
                        <td>Enter Site Name</td>
                        <td colspan="2"><input type="text" class="input-field-large"  /></td>
                      </tr>
                      <tr>
                        <td>Enter Site Url</td>
                        <td colspan="2"><input type="text" class="input-field-large"  /></td>
                      </tr>
                      <tr>
                        <td>Click Reveal Setting</td>
                        <td colspan="2"><input type="text" class="input-field-large"  /></td>
                      </tr>
                      <tr>
                        <td colspan="3">
                        	<div class="btn">
                        	<input type="Button" class="btn" value="UPDATE" />
                        	</div>
                        </td>
                      </tr>
                    </table>
                    </form>
<script>
$(document).ready(function() {
	$(".siteSetting-widget-container .content1-widget-container .detail .right .description1").show();
	$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();

	$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(1)").mouseover(function() {
		$(".siteSetting-widget-container .content1-widget-container .detail .right").children().hide();
		$(".siteSetting-widget-container .content1-widget-container .detail .right .description1").show();
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(1)").css('border-left-color','#504f4f');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(2)").css('border-left-color','#ad3a3a');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(3)").css('border-left-color','#ad3a3a');
	
	});
	$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(2)").mouseover(function() {
		$(".siteSetting-widget-container .content1-widget-container .detail .right").children().hide();
		$(".siteSetting-widget-container .content1-widget-container .detail .right .description2").show();
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(2)").css('border-left-color','#504f4f');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(3)").css('border-left-color','#ad3a3a');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(1)").css('border-left-color','#ad3a3a');
	
	});
	$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(3)").mouseover(function() {
		$(".siteSetting-widget-container .content1-widget-container .detail .right").children().hide();
		$(".siteSetting-widget-container .content1-widget-container .detail .right .description3").show();
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(3)").css('border-left-color','#504f4f');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(2)").css('border-left-color','#ad3a3a');
		$(".siteSetting-widget-container .content1-widget-container .detail .left li:nth-child(1)").css('border-left-color','#ad3a3a');
	});

});
</script>
                </div>
            </div>
        </div>
        <!-- SITE SETTTING END -->

    </div>
    <!-- MID CONTAINER END -->
