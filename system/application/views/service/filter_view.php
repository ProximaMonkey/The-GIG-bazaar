<div id="content">

<div id="listing">
		 	<?php
			if($this->session->userdata('logged_in') == TRUE)
			{
			?>
	<!-- I will 
	 <form action="<?php echo site_url('service/postajob');?>" id="" method="post">
		<div class="iwill">
		<p>What are you willing to do for <?php echo CURRENCY." ".MINIMUM_BALANCE;?>?</p>
		<div class="holder">
			<div class="txt">I will </div><div class="f"><input class="text" id="quicktitle" name="quicktitle" type="text" value="" /></div><div class="txt">for <?php echo CURRENCY." ".MINIMUM_BALANCE;?></div>
			<div class="img"><input type="submit" value="Continue" class="ssubmit"></div>
		</div>
	</div>
	</form>-->
	<?php
	}
	?>

	<div id="main-nav">
	<ul>


	<li class="selected"><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
	</div><!--main nav ends-->
     <?php $this->load->view('sidebar');?>
    <div id="gig-listings">
		
		<?php echo $gigs;?>
		
													<div class="pagination">
														<?php echo $pagination;?>
													</div>
                                                    </div><!--gig-listings ends-->
                                                   

</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->

</div><!--content ends-->



