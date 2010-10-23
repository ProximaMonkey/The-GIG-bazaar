<div id="content">
<?php $this->load->view('sidebar');?>
<div id="listing">
<div id="main-content">
<h2>Login</h2>
	<?php echo $this->session->flashdata('message'); ?>
	<?php if($error != "") echo "<div class='form-error'>".$error."</div>";?>
		<form method="post" action="<?php echo site_url('member/login');?>" id="newuser">
			<input type='hidden' name='ref' value="<?php echo $referrer;?>">
							<ul>
				<li><label>Username</label><div><input type="text" name="username" id="username" class="text medium" value=""></div></li>
						
				
				<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""></div></li>
				<li><div><input type="submit" value="login" name="submit" id="submit"></div> </li>
					<li><div><a href="<?php echo site_url('member/forgotpassword');?>">Forgot Password</a></div> </li>
					<li><div>Don't have a account? <a href="<?php echo site_url('main/signup');?>">Signup here</a></div> </li>
		</ul>
	</form>
</div><!--main-content ends-->
</div><!--listing ends-->

</div><!--content ends-->



