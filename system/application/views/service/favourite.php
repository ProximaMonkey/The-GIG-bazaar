<div id="content">
<div id="listing">


	<div id="main-nav">
    
    
	<ul>


	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li class="selected"><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
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



