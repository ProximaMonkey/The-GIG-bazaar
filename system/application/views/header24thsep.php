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
	<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>

	<?php if ( !$fbdata['user_id'] ):
	if($this->session->userdata('logged_in') != TRUE)
	{ ?>
		<fb:login-button onlogin="window.location='<?=current_url()?>'"></fb:login-button>
	<?php
	}
	?>
	<?php else:
	if($this->session->userdata('logged_in') != TRUE)
	{
	$user_check = $this->Main_model->checkuser($fbdata['user']['uid']);
	if($user_check == 'exists')
	{
		$this->db->where('member_facebook',$fbdata['user']['uid']);
		$q = $this->db->get('members');
		$r = $q->row();
		$data = array(
	                 'username'  => $r->member_username,
									 'logged_in'  => TRUE,
										'id' => $r->id,
										'level' => $r->level
									  );
			$this->session->set_userdata($data);
			header('Location: http://dev.thegigbazaar.com');
	}
	else {
		$url = site_url('index.php/main/signup');
		redirect($url);
	}
	}
	 ?>
		<a href="#" onclick="FB.Connect.logout(function() { window.location='<?=site_url('member/logout')?>' }); return false;" >(Logout)</a>
	<?php endif; ?>
	<script type="text/javascript">
		FB.init("<?=$this->config->item('facebook_api_key')?>", "/xd_receiver.htm");
	</script>
	
	<?php /*if ($cookie) { 
			//Check if the user is registered in the system, if not then register him/her
			$user_check = $this->Main_model->checkuser($cookie['email']);
			$user = json_decode(file_get_contents(
			    'https://graph.facebook.com/me?access_token=' .
			    $cookie['access_token']))->id;
					
			if($user_check == 'exists')
			{
				$this->db->where('member_email',$user->email);
				$q = $this->db->get('members');
				$r = $q->row();
				$data = array(
			                 'username'  => $r->member_username,
											 'logged_in'  => TRUE,
												'id' => $r->id
											  );
					$this->session->set_userdata($data);
			}
			else {
				//print_r($user);
				//$this->Main_model->register_user($cookie['uid'],$user->email,$user->name,$user->username);
				//$url = site_url('index.php/main/signup');
				//redirect($url);					
			}		*/
		?><!--
		Your userid is <?php //echo $cookie['uid'];?>
	 	<fb:login-button autologoutlink="true" perms="email"></fb:login-button>
    <?php //} //else { ?>
      <fb:login-button autologoutlink="true" perms="email"></fb:login-button>
    <?php //} ?>

    <div id="fb-root"></div>-->
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
				echo "</li><li> <a href='".site_url('/member/ordered')."'>Your Orders</a></li>";
				echo "</li><li> <a href='".site_url('member/gigs/')."'>Start Selling</a></li>";
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
</div><!--header-wrapper-->