<div id="content">
<div id="listing">
	<div id="main-nav">
	<ul>
	<li class="selected"><a href="#">tag filter</a> </li>
	
	</ul>
	</div><!--main nav ends-->
		
		<?php echo $gigs;?>
		
													<div class="pagination">
														<?php echo $pagination;?>
													</div>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



