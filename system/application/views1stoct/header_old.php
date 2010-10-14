<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $title;?></title>
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
	</head>

<body>
<div  class="wrapper_860">
<div class="masthead">
    <h1 id="logo"><a href="<?php echo base_url();?>" tile="Site Logo">TheGigBazaar</a></h1>

	<ul class="navigation">
       <a href="<?php echo base_url();?>">Home</a> | 
 				 	<?php
					if($this->session->userdata('logged_in') != TRUE)
					{
					?>
					 <a href="<?php echo site_url('/main/login');?>">Login</a> | <a href="<?php echo site_url('main/signup');?>">Sign up</a>
					<?php }
					else {
						echo "Welcome <b style='color:orange'>".$this->session->userdata('username');
						echo " | <a href='".site_url('member/inbox')."'>Inbox <span id='unread'>".$unread."</span></a>";
						if($this->session->userdata('level') == '2') // Means that the user is a seller
						{
						echo " </b>| <a href='".site_url('member/gigs/')."'>Gigs</a> | ";
						}
						else {
							echo "</b> | ";
						}
						echo "<a href='".site_url('member/settings/')."'>Settings</a> | ";?>
						<?php
						if($this->session->userdata('level') == '-1')
						{
						?>
						<a href="<?php echo site_url('/admin');?>">Admin</a> |
						<?php
						}
						?>
						<?php echo " <a href='".site_url('member/logout')."'>Logout</a>";
					}
					?>
    </ul>
	<div id="message">
		Services at prices you can afford
	</div>
</div> <!-- end of masthead -->