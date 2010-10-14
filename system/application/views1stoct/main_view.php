<div id="banner">
<div id="how_work_button">

<a href="<?php echo base_url();?>how_work.html?keepThis=true&amp;TB_iframe=true&amp;height=518&amp;width=659" class="thickbox" title="">

How does it work?
</a>

</div><!--how work button ends-->
</div><!--banner ends-->
<div id="content">
<div id="listing">
<div id="main-nav">
<ul>
<li class="selected"><a href="<?php echo site_url('main/index');?>">hot</a></li>
<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
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
<div class="clr"></div>

</div><!--content ends-->



