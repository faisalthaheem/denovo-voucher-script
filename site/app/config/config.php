<?php 
$config = array(
	'Mail' => array(
		'support' => 'support@voucherscript.com',
		'noreply' => 'Do Not Reply <noreply@voucherscript.com>',
		'feedback' => 'info@voucherscript.com',
		//'method' => 'smtp',
		'method' => 'mail'
	)
	
	,'site' => array(
		'adminLoginCredits' => true
	)
	
	# TODO: change the following verification url to appropriate domain when going live
	,'URLs' => array(
		'verificationURL' => 'http://##site##/users/verify_email/'
		,'unsubscribeURL' => 'http://##site##/subscriptions/unsubscribe/##emailaddress##'
	)
	
	,'PictureTags' => array(
		'Original' => 'original-picture' # Original Picture with Original Size
		,'ProfileView' => 'profile-view-picture' # Size:108 X 81 - On View Profile
		,'Avatar' => 'avatar-picture' # Size:180 X 123 - On top of Dashboard Menu
		,'ProfileViewPictureWidget' => 'pictures-widget-view' # # Size:196 X 147 - Pictures Widget View artists
		,'TinyPicture' => 'tiny-picture' # Size:51 X 38 - This is used on many places, for example:In Search Results, Inbox, Shouts etc
		,'PopupPicture' => 'popup-picture' # Size:450 X 320 - For pop up images
		,'Banner' => 'banner'
		,'Logo' => 'logo',
		'Voucher' => 'voucher'
	)
	,'PrintableVouchersTemplates' => array(				
		'Default' =>  'print-voucher-default'
	),
	'Layouts' => array(
		//file names that can be used to render cms pages
		//this list is used on cms page add/edit
		'default' => 'Default Layout'
	)
);

define('CACHE1HR',3600);  //1 hour
define('CACHE8HR',28800); //8 hour
define('CACHE24HR',86400); //24 hour
define('CACHEANNUAL',31536000); //1 year
?>