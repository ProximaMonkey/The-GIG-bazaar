<div id="content">
	<?php $this->load->view('sidebar');?>
   <div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends--> 
    
    
	<div class="listing" style="margin-left:20px;">
		<h1 class="content_title">Services at prices you can afford</h1>
			 <h3>Are you sure you want to delete this gig? There is no going back</h3><br/>
			<?php echo $this->session->flashdata('message'); ?>
			<?php echo $delete_details;?>
			
	</div><!-- Listing -->
	
	
	</div>
	
