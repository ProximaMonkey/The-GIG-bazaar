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
<title><?php echo $title;?></title>
</head>
<body>
<div id="wrapper">

<div id="top-nav">
<div id="top-nav-left"></div><!--top-nav-left ends-->

<div id="top-nav-middle">

<div class="left-align">
<ul>
<?php if ( !$fbdata['user_id'] )
{
	if($this->session->userdata('logged_in') != TRUE)
	{ ?>
		<fb:login-button onlogin="window.location='<?=current_url()?>'"></fb:login-button>
	<?php
	}
}
	?>
 	<li><a href="<?php echo site_url('/main/index');?>">home</a></li>
		 	<?php
			if($this->session->userdata('logged_in') != TRUE)
			{
			?>
					
			 <li><a href="<?php echo site_url('/main/login');?>">login</a></li>
			<li><a href="<?php echo site_url('/main/faq');?>">faq</a></li>
			<li><a href="<?php echo site_url('/main/about');?>">about us</a></li>
			<?php }
			else {
	
				echo "<li><a href='".site_url('member/inbox')."'>Inbox <span id='unread'>".$unread."</span></a>";
				if($this->session->userdata('level') == '2') // Means that the user is a seller
				{
				echo "</li><li> <a href='".site_url('member/gigs/')."'>Gigs</a></li>";
				}
				else {
					echo "";
				}
				echo "<li><a href='".site_url('member/settings/')."'>Settings</a></li> ";?>
				<?php
				if($this->session->userdata('level') == '-1')
				{
				?>
				<li><a href="<?php echo site_url('/admin');?>">Admin</a></li>
				<?php
				}
				if($fbdata['user']['uid'] == "")
				{
					echo "<li><a href='".site_url('member/logout')."'>Logout</a></li>";
				}
		
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
</div><!--header-wrapper--><div id="content">
<div id="listing">
<h2>Sign up with The GigBazaar : Facebook</h2>
<div class="form-error"><?php echo $error; ?></div>
<div class="form-error"><?php echo validation_errors(); ?></div>
	<form method="post" action="<?php echo site_url('main/verify');?>" id="newuser">
						<ul>
			<li><label>Username</label><div><input type="text" name="username" id="username" class="text medium" value=""></div></li>			
			
			<li><label>Profile Picture</label><div><img class="profile_square" src="<?=$fbdata['user']['pic_square']?>" /></div></li>
			<input type='hidden' name='email' value='<?php echo $fbdata['user']['email'];?>'>
			<li><div><input type="submit" value="register" name="submit" id="submit"></div> </li>
	</ul>
</form>
<?php $this->load->view('sidebar');?>
</div><!--content ends-->