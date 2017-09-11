<?php
//debug($friends,true); 
?>

<div id="widget-friends-radioselector-container" class="friends-radioSelector-widget-container">
	
	<div id="widget-friends-radioselector-filter-container">
		<input type="text" id="widget-friends-radioselector-filter" class="inputField-type-medium" />
	</div>
	
	<div id="widget-friends-radioselector-filtered-results" class="results-Div">
	</div>
</div>

<script type="text/javascript">

	var myFriends = jQuery.parseJSON('<?php echo $friends;?>'); 
	var filteredFriends = new Array();
	
	$(document).ready(function(){
		$("#widget-friends-radioselector-filter").keyup(function(){
			var filterText = $("#widget-friends-radioselector-filter").val();
			filterFriends( filterText );
			renderFriendsRadioList();
		});

	});

	//copy all friends to the filtered list
	for(i = 0; i<myFriends.length; i++)
	{
		filteredFriends.push(myFriends[i]);
	}
	//initially show all friends
	renderFriendsRadioList();

	//called when #widget-friends-radioselector-filter changes
	function filterFriends(nameFilter)
	{
		filteredFriends = new Array(); //reset
		for(i = 0; i<myFriends.length; i++)
		{
			if( myFriends[i].User.fullname.indexOf(nameFilter) >= 0)
			{
				filteredFriends.push(myFriends[i]);
			}
		}
	}

	function renderFriendsRadioList()
	{
		$("#widget-friends-radioselector-filtered-results").html('');
		
		for(i = 0; i<filteredFriends.length; i++)
		{
			$("#widget-friends-radioselector-filtered-results").append(
					"<div class='result'><div class='img'><img src='/files/pictures/<?php echo Configure::read('PictureTags.TinyPicture');?>-" + filteredFriends[i].User.Picture[0].uuidtag + ".png' /></div><div class='txt'><input type=radio name='selected-friend-id' value='"+ filteredFriends[i].User.id +"'/><label>" + filteredFriends[i].User.fullname + "</label></div></div>"
			);

			if($("input[name=selected-friend-id]").length > 0)
			{
				$("input[name=selected-friend-id]:eq(0)").attr('checked','checked');
			}
		}		
	} 

	function getFriendNameFromId(friendid)
	{
		for(i = 0; i<myFriends.length; i++)
		{
			if( myFriends[i].User.id == friendid)
			{
				return myFriends[i].User.fullname;
			}
		}		
	}

</script>