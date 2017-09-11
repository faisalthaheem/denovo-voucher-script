
<?php 
	 if(isset($verified) && $verified)
	 {
?>
	<div class="sign-up-success-widget-container">
    	<div class="sign-up-success-widget-txt-1"><?php __('Account Activated');?>..!</div>
        <div class="sign-up-success-widget-txt-2">
        	<?php __('Your account is now activated, please sign in using your email, password and enjoy!');?>
        </div>
	</div>
	
<?php 
	 }
	 else 
	 {
?>
	<div class="sign-up-success-widget-container">
    	<div class="sign-up-success-widget-txt-1"><?php __('Account Activation Failed');?>!</div>
        <div class="sign-up-success-widget-txt-2">
        	<?php __('Either your account is already activated or the verification email is expired.');?>
        </div>
	</div>

<?php 
	 }
?>