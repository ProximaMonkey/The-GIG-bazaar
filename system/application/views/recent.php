<div id="banner">
<div id="how_work_button"><a href="#">How does it work?</a></p></div><!--how work button ends-->
</div><!--banner ends-->
<div id="content">
<div id="listing">

<div id="main-nav">
<ul>
<li><a href="<?php echo site_url('main/index');?>">hot</a></li>
<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
<li class="selected"><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
</ul>
</div><!--main nav ends-->
<?php $this->load->view('sidebar');?>
<div id="gig-listings">
<?php echo $gigs;?>
<div class="pagination">
	<?php echo $pagination;?>
</div>
</div><!--gig listing ends-->
</div><!--listing ends-->

</div><!--content ends-->



