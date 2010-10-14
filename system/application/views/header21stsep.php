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
	<?php if ($cookie) { 
			//Check if the user is registered in the system, if not then register him/her
		/*	echo $cookie['access_token'];
			echo "OAuth".$cookie['oauth_access_token'];			
			echo "email".$cookie['email'];			
			$user_check = $this->Main_model->checkuser($cookie['email']);
			$user = json_decode(file_get_contents(
			    'https://graph.facebook.com/me?wrap_access_token=' .
			    $cookie['uid']))->me;
					
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
				$this->Main_model->register_user($cookie['uid'],$user->email,$user->name,$user->username);
				redirect('http://dev.thegigbazaar.com/');					
			}		*/
		?>
		Your userid is <?php echo $cookie['uid'];?>
	 	<fb:login-button autologoutlink="true" perms="email"></fb:login-button>
    <?php } else { ?>
      <fb:login-button autologoutlink="true" perms="email"></fb:login-button>
    <?php } ?>

    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      FB.init({appId: '<?= FACEBOOK_APP_ID ?>', status: true,
               cookie: true, xfbml: true});
      FB.Event.subscribe('auth.login', function(response) {
	     window.location.reload();
      });
    </script>
  
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
				?>
				<?php echo "<li><a href='".site_url('member/logout')."'>Logout</a></li>";
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