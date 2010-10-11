<div id="content">
<div id="listing">
<h1 class="content_title">Settings &rarr; Edit Profile</h1>
<ul id="menu">
<li class="highlight"><a href="<?php echo site_url('member/settings');?>">Edit Profile</a></li>
<li class="mainitems"><a href="<?php echo site_url('member/payment');?>">Payment</a></li>			
</ul>
<div id="clear"></div>

	<?php echo $this->session->flashdata('message'); ?>
	<form method="post" action="<?php echo site_url('member/modify');?>" id="modifyusers">
						<ul>
									
			<li><label>Email Address</label><div><input type="text" name="email" id="email" class="text medium" value="<?php echo $member_detail['member_email']; ?>"></div></li>
			<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""><span>Leave blank to leave as is</span></div></li>
			
				<li><label>Repeat Password</label><div><input type="password" name="password1" id="password1" class="text medium" value=""/></div></li>
				
					<li><label>Name</label><div><input type="text" name="name" id="name" class="text medium" value="<?php echo $member_detail['member_name'];?>"/></div></li>
					
						<li><label>Description</label><div><textarea name="description" id="description" class="textarea medium"><?php echo $member_detail['member_description'];?></textarea></div></li>
		<div></div></li>
	<li><div><input type="submit" value="update details" name="submit" id="submit"></div> </li>
	</ul>
</form>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



