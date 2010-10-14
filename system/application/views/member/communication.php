<div id="content">
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
			<ul id="menu">
			<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
			<li class="highlight"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
			<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
			</ul>
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">You have accepted the order.</h1>
				<br/>
				<p>Leave a message for the buyer below and click "Notify Buyer" to notify the buyer</p>
				
					
						<form method="post" action="<?php echo site_url('gig/sendmessage');?>" id="sendmessage">
										<ul>
							<li><label>Message to buyer</label><div><textarea name="firstmessage" id="firstmessage" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="orderid" value="<?php echo $orderid;?>">
								<li><div><input type="submit" value="Notify Buyer" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	
		
	</div>
	
