<div id="content">
<div id="listing">
<h2>Sign up with The GigBazaar</h2>
<div class="form-error"><?php echo validation_errors(); ?></div>
	<form method="post" action="<?php echo site_url('main/verify');?>" id="newuser">
						<ul>
			<li><label>Username</label><div><input type="text" name="username" id="username" class="text medium" value="<?php echo set_value('username'); ?>"></div></li>
					
			<li><label>Email Address</label><div><input type="text" name="email" id="email" class="text medium" value="<?php echo set_value('email'); ?>"></div></li>
			<li><label>Password</label><div><input type="password" name="password" id="password" class="text medium" value=""></div></li>
			
				<li><label>Repeat Password</label><div><input type="password" name="password1" id="password1" class="text medium" value=""></div></li>
		
			<li><label>We will be sending a verification email address to the email address provided.</label><div></div></li>
	<li><div><input type="submit" value="register" name="submit" id="submit"></div> </li>
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



