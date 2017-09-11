              <div class="about-me-widget-container">
                  <div class="about-me-widget-title"><?php __('About Me');?></div>
                  <div class="about-me-widget-detail">
                      <div class="about-me-widget-row">
                          <div class="about-me-widget-column-left">
                              <div class="about-me-widget-heading"><?php __('Name');?></div>
                              <div class="about-me-widget-txt" id="name-txt">
                              	<?php echo $user['User']['fullname']; ?>
                              </div>
                          </div>
                          <div class="about-me-widget-column-right">
                              <div class="about-me-widget-heading"><?php __('Nationality');?></div>
                              <div class="about-me-widget-txt"><?php echo $user['User']['nationality']; ?></div>
                          </div>
                      </div>
                      <div class="about-me-widget-row">
                          <div class="about-me-widget-column-left">
                              <div class="about-me-widget-heading"><?php __('Age');?></div>
                              <div class="about-me-widget-txt"><?php echo (date('Y') - date('Y',strtotime($user['User']['dob']))); ?></div>
                          </div>
                      </div>
                  </div>
              </div>