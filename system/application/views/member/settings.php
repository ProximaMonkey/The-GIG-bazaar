<div id="content">
<div id="listing">

<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>





<h1 class="content_title">Settings &rarr; Edit Profile</h1>
<ul id="menu">
<li class="highlight"><a href="<?php echo site_url('member/settings');?>">Edit Profile</a></li>
<li class="mainitems"><a href="<?php echo site_url('member/payment');?>">Payment</a></li>			
</ul>
<div id="clear"></div>

	<?php echo $this->session->flashdata('message'); ?>
	<form method="post" action="<?php echo site_url('member/modify');?>" id="modifyusers">
						<ul>
									
			
									<?php if($fbdata['user']['email'] != "") {?>
			<li><label>Email Address</label><div><input type="text" name="email" id="email" class="text medium" value="<?php echo $member_detail['member_email']; ?>" disabled></div><span>Your account is connected to <b>Facebook</b> and hence cannot be modified</span></li>
			<?php
			}
			else {
			?>
			<li><label>Email Address</label><div><input type="text" name="email" id="email" class="text medium" value="<?php echo $member_detail['member_email']; ?>"></div></li>
			<?php
			}
			?>
			<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""><span>Leave blank to leave as is</span></div></li>
			
				<li><label>Repeat Password</label><div><input type="password" name="password1" id="password1" class="text medium" value=""/></div></li>
				
					<li><label>Name</label><div><input type="text" name="name" id="name" class="text medium" value="<?php echo $member_detail['member_name'];?>"/></div></li>
					
						<li><label>Description</label><div><textarea name="description" id="description" class="textarea medium"><?php echo $member_detail['member_description'];?></textarea></div></li>
		<div></div></li>
	<li><div><input type="submit" value="update details" name="submit" id="submit"></div> </li>
	</ul>
</form>

</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->
</div><!--content ends-->



