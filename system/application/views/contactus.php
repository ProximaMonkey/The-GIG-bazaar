<div id="content">
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Contact Us</h1>
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">You can write to us using the form below.</h1>
				<br/>
				
					
						<form method="post" action="<?php echo site_url('main/sendcontact');?>" id="sendmessage">
										<ul>
													<li><label>Name</label><div><input name="name" id="name" class="text medium"></div></li>
											
															<li><label>Email</label><div><input name="email" id="email" class="text medium"></div></li>
											
							<li><label>Message</label><div><textarea name="message" id="message" class="textarea medium"></textarea></div></li>
								<li><div><input type="submit" value="Submit" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	
		
	</div>
	
