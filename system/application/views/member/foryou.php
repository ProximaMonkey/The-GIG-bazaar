<div id="content">
<div id="listing">
	<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>
  
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
			<ul id="menu">
			<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
			<li class="highlight"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
			<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
			</ul>
             
             
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Gigs for you</h1>
			<?php echo $foryou;?>
  
</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->
</div><!--content ends-->



