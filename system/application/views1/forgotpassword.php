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



