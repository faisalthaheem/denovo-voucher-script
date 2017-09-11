		<div class="detail">
			<div id="news-items">
			</div>
		</div>

		<script type="text/javascript">

		jQuery(function() {

		    jQuery.getFeed({
		        url: '/admin/sites/news',
		        success: function(feed) {

		            jQuery('#news-items').append('<h2>'
		            + '<a href="'
		            + feed.link
		            + '" target="_blank">'
		            + feed.title
		            + '</a>'
		            + '</h2>');

		            var html = '';

		            for(var i = 0; i < feed.items.length && i < 5; i++) {

		                var item = feed.items[i];

		                html += '<h3>'
		                + '<a href="'
		                + item.link
		                + '" target="_blank">'
		                + item.title
		                + '</a>'
		                + '</h3>';

		                html += '<div class="updated">'
		                + item.updated
		                + '</div>';

		                html += '<div>'
		                + item.description
		                + '</div>';
		            }

		            jQuery('#news-items').append(html);
		        }
		    });
		});

		</script>