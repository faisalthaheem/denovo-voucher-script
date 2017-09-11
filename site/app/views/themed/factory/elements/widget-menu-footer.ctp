                <div class="nav-container">
                    <a href="/"><?php __('Home');?></a> 
                    |
						<?php
							echo $this->Html->link(
								__('Categories',true)
								,'/categories/index' 
							); 
						?>
                    |
						<?php
							echo $this->Html->link(
								__('Everything',true)
								,'/cods/everything' 
							); 
						?>
                    |
						<?php
							echo $this->Html->link(
								__('New Stuff',true)
								,'/cods/new_stuff' 
							); 
						?>
                    |
						<?php
							echo $this->Html->link(
								__('Expiring Stuff',true)
								,'/cods/expiring_stuff' 
							); 
						?>
                </div>