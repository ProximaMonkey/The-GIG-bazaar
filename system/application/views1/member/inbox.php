<div id="content">
<div id="listing">
	<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>

			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Inbox</h1>
			<form method='post' action='<?php echo site_url('member/delete');?>'>
		<?php echo $inbox;?>
	
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



