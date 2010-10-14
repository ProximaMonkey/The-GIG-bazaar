<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Facebook Connect Test</title>
</head>
<body>
	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
	<?php if ( !$fb['user_id'] ): ?>
		<fb:login-button perms='email' 	onlogin="window.location='<?=current_url()?>'"></fb:login-button>
	<?php else: ?>
		<img class="profile_square" src="<?=$fb['user']['pic_square']?>" />
		Hi <?=$fb['user']['first_name']?>!<br />
	adadasdsad	<?=$fb['user']['email']?>
		<a href="#" onclick="FB.Connect.logout(function() { window.location='<?=current_url()?>' }); return false;" >(Logout)</a>
	<?php endif; ?>
	
	<h2>Here's some comments!</h2>
	<fb:comments title="Facebook Connect Test" width="580px"></fb:comments>
	
	<script type="text/javascript">
		FB.init("<?=$this->config->item('facebook_api_key')?>", "/xd_receiver.htm");
	</script>
</body>
</html>