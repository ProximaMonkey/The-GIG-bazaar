<div id="content">
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
		
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Raise a dispute</h1>
				<br/>
				<p>Enter the reason why you want to raise a dispute</p>
				
					
						<form method="post" action="<?php echo site_url('gig/raise_dispute/'.$id);?>" id="sendmessage">
										<ul>
							<li><label>Reason</label><div><textarea name="Reason" id="Reason" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<li><div><input type="submit" value="Send Message" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	
