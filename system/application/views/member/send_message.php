<div id="content">
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
		
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Send a message</h1>
				<br/>
				<p>Send a message for the seller below</p>
				
					
						<form method="post" action="<?php echo site_url('main/send_contact');?>" id="sendmessage">
										<ul>
                                        	<li><label>Subject</label><div><input  name="subject" id="subject" class="text medium"/></div></li>
							<li><label>Message to seller</label><div><textarea name="contact" id="contact" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<li><div><input type="submit" value="Send Message" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	

	
