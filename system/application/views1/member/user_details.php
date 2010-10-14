<div id="content">
<div id="listing">

	<div id="user_layout">
	<div id="user_image">
		<img src="<?php echo base_url();?>" alt="<?php echo $user['member_username'];?>'s picture">
	</div>
	<div id="user_description">
	 <h2><?php echo $user['member_username'];?></h2><br/>
	<p><?php echo $user['member_description'];?></p>
	
	</div>

	<div id="user_gigs">
		<?php echo $gigs;?>
		
		
	</div>	
	</div><!--USer Layout-->

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



