<div id="content">
	<?php echo $this->load->view('sidebar');?>
  <div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->  
    
    
	<div class="listing" style="margin-left:10px;">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
			<ul id="menu">
			<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
			<li class="highlight"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
			<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
			</ul>
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Order has been rejected</h1>
				<br/>
				<p>Leave a message for the buyer below and click "Notify Buyer" to notify the buyer that you will not be accepting the order.</p>
				
					
						<form method="post" action="<?php echo site_url('gig/rejectmessage');?>" id="rejectmessage">
										<ul>
							<li><label>Message to buyer for rejecting the order.</label><div><textarea name="firstmessage" id="firstmessage" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="orderid" value="<?php echo $orderid;?>">
								<li><div><input type="submit" value="Notify Buyer" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	
	
