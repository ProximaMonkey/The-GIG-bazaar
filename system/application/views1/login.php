<div id="content">
<div id="listing">
<h2>Login</h2>
	<?php echo $this->session->flashdata('message'); ?>
	<?php if($error != "") echo "<div class='form-error'>".$error."</div>";?>
		<form method="post" action="<?php echo site_url('member/login');?>" id="newuser">
							<ul>
				<li><label>Username</label><div><input type="text" name="username" id="username" class="text medium" value=""></div></li>
						
				
				<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""></div></li>
				<li><div><input type="submit" value="login" name="submit" id="submit"></div> </li>
					<li><div><a href="<?php echo site_url('member/forgotpassword');?>">Forgot Password</a></div> </li>
					<li><div>Don't have a account? <a href="<?php echo site_url('main/signup');?>">Signup here</a></div> </li>
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



