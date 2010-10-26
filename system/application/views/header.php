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
					<script type='text/javascript' src='<?php echo base_url();?>js/jquery.js'></script>
					<script type='text/javascript' src='<?php echo base_url();?>js/gigbazaar.js'></script>
					<script type="text/javascript" src='<?php echo base_url();?>js/thickbox.js'></script>
					<link href="<?php echo base_url();?>css/thickbox.css" rel="stylesheet" type=	"text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?></title>
<!--Google Analytics-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-686180-9']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--analytics ends-->
</head>
<body>
<div id="wrapper">

<div id="top-nav">
<div id="top-nav-left"></div><!--top-nav-left ends-->

<div id="top-nav-middle">

<div class="left-align">
<ul>
	 <li><a href="<?php echo site_url('/main/index');?>">home</a></li>
		 	<?php
			if($this->session->userdata('logged_in') != TRUE)
			{
			?>
			<li><a href="<?php echo site_url('/main/signup');?>">join</a></li>
			<li><a href="<?php echo site_url('/main/login');?>">login</a></li>
			<li><a href="<?php echo site_url('/main/faq');?>">faq</a></li>
			<?php }
			else {
	
				echo "<li><a href='".site_url('member/inbox')."'>Inbox <span id='unread'>(".$unread.")</span></a>";
				echo "</li><li> <a href='".site_url('/member/ordered')."'>Your Orders</a></li>";
				echo "</li><li> <a href='".site_url('member/gigs/')."'>Start Selling</a></li>";
				echo "<li><a href='".site_url('member/settings/')."'>Settings</a></li> ";?>
				<?php
				if($this->session->userdata('level') == '-1')
				{
				?>
				<li><a href="<?php echo site_url('/admin');?>">Admin</a></li>
				<?php
				}
				?>
				<li><a href="<?=site_url('member/logout')?>">Logout</a></li>
				
			<?php
					}
			?>
			<li>
<form method="post" action="<?php echo site_url('gig/search');?>">
<input type="text" class="input-box-border" name="q" id="q"/>
</form>
</li>
</ul>
</div><!--left ends-->
</div><!--top-nav-middle ends-->

<div id="top-nav-right"></div><!--top-nav-right ends-->
</div><!--top-nav ends-->

<div id="header-wrapper">
<a id="logo" href="<?php echo base_url();?>"></a>

<div id="post-button"><a href="<?php echo site_url('gig/postajob');?>" class="button-links post">Post a GIG</a></div><!--post-button ends-->
<div class="clr"></div>
</div><!--header-wrapper-->