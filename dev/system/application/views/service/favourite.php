<div id="content">
<div id="listing">


	<div id="main-nav">
	<ul>


	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li class="selected"><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
	</div><!--main nav ends-->
		
		<?php echo $gigs;?>
		
													<div class="pagination">
														<?php echo $pagination;?>
													</div>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



