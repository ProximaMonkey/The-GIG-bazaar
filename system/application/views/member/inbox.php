<div id="content">
<div id="listing">

<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>
    
    
    
	<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>

			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Inbox</h1>
			<form method='post' action='<?php echo site_url('member/delete');?>'>
		<?php echo $inbox;?>
	
		</form>

</div><!--listing ends-->

<div class="clr"></div><!--clr ends-->

</div><!--content ends-->



