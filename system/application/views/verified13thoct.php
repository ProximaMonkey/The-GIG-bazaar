<div id="content">

<div id="listing">

<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>

		<h1 class="content_title">Email Verification</h1>
			<br/>
				<?php echo $this->session->flashdata('message'); ?>

</div><!--listing ends-->

</div><!--content ends-->



