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
<div id="about-box">

<div class="padding">

<h2>The GiG Bazaar </h2>is a 
place for blah blah blah 
about us information is to 
come here.No registration,
 pay by indian credit cards
 or bank accounts easily. 
</div><!--padding ends-->

<div class="sublinks">
<ul>
<li><a href="#">about</a></li>
<li><a href="#">how it works</a></li>
</ul>
</div><!--sublink ends-->


</div><!--aboutbox ends-->

<div id="categories">

<h2 class="padding">Gig Categories</h2>
<ul>
	<?php echo $category;?>

</ul>
</li>
</div><!--categories ends-->
</div><!--content ends-->



