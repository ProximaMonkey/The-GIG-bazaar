<div id="content">
<div id="listing">
<h2>Forgot Password</h2>
<?php echo $this->session->flashdata('message'); ?>

	<form method="post" action="<?php echo site_url('member/forgot');?>" id="newuser">
						<ul>
			<li><label>Enter Email Address here</label><div><input type="text" name="email" id="email" class="text medium" value=""></div><span>Enter your email address used during sign up here. We will email you your username and password.</li>
					<li><label></label><div><input type="submit" value="Send Password"></div><span></li>
	</ul>
</form>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



