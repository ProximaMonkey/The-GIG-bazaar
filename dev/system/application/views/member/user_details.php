<div id="content">
<div id="listing">
<div id="main-nav">
<ul>
<li><a href="<?php echo site_url('main/index');?>">hot</a></li>
<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
</ul>
</div><!--main nav ends-->
<?php $this->load->view('sidebar');?>
<div id="main-content">
	<div id="user_layout">
	<div id="user_image">
			<img src='<?php echo base_url();?>/assets/timthumb.php?src=<?php echo $user['member_picture'];?>&h=56&w=56&zc=1' alt=''>
	</div>
	<div id="user_description">
	 <h2><?php echo $user['member_username'];?></h2><br/>
	<p><?php echo $user['member_description'];?></p>
	
	</div>

	<div id="user_gigs">
		<?php echo $gigs;?>
		
		
	</div>	
	</div><!--user Layout-->
</div><!--main content ends-->
</div><!--listing ends-->

</div><!--content ends-->



