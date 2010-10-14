<div id="content">
<div id="listing">
	<div id="main-nav">
	<ul>
	<li class="selected"><a href="#">tag filter</a> </li>
	
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
<div class="clr"></div><!--clr ends-->

</div><!--content ends-->



