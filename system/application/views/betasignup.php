<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<?php
	   	$link = array(
			          'href' => 'css/style.css',
			          'rel' => 'stylesheet',
			          'type' => 'text/css',
			          'media' => 'screen'
			);

			echo link_tag($link);
			?>
					<script type='text/javascript' src='<?php echo base_url();?>/js/jquery.js'></script>
					<script type='text/javascript' src='<?php echo base_url();?>/js/gigbazaar.js'></script>
					<script type="text/javascript" src='<?php echo base_url();?>/js/thickbox.js'></script>
					<link href="thickbox.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thegigbazaar Signup</title>
</head>
<body>
<div id="wrapper">


<div id="header-wrapper">
<a id="logo" href="<?php echo base_url();?>"></a>

<div class="clr"></div>
</div><!--header-wrapper-->
<div id="content">
<div id="listing">
<h2>Sign up with The GigBazaar</h2>
<div class="form-error"><?php echo $this->session->flashdata('message'); ?></div>
	<form method="post" action="<?php echo site_url('beta/processsignup');?>" id="newuser">
						<ul>
			<li><label>Username</label><div><input type="text" name="username" id="username" class="text medium" value="<?php echo set_value('username'); ?>"></div></li>
					
			<li><label>Email Address</label><div><input type="text" name="email" id="email" class="text medium" value="<?php echo set_value('email'); ?>"></div></li>
			<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""></div></li>
			
				<li><label>Repeat Password</label><div><input type="password" name="password1" id="password1" class="text medium" value=""></div></li>
		
	<li><div><input type="submit" value="register" name="submit" id="submit"></div> </li>
	</ul>
</form>

</div><!--listing ends-->

</div><!--content ends-->

<div id="footer">
	<hr>
	<span>&copy; All Rights Reserved. 
	<div class="verisign-img footerimg"></div><!--verisign img-->
	<div class="pci-img footerimg"></div><!--vci-img ends-->
	<div class="pay">Pay with: </div>
	<div class="mastercard-img footerimg"></div><!--mastercard ends-->
	<div class="visa-img footerimg"></div><!--visa-img ends-->
	
</div>
</div><!--Content-->
</div><!--Wrapper-->


</body>
</html>


