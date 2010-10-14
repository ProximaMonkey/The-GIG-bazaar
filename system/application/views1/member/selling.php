<div id="content">
<div id="listing">
	<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
		<ul id="menu">
		<li class="highlight"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
		<li class="mainitems"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
		<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
		</ul>
			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Gigs by you</h1>
		<?php echo $selling;?>

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



