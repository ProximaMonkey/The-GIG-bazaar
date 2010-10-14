<div id="content">
	
	<div class="listing">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
		
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Send a message</h1>
				<br/>
				<p>Send a message for the seller below</p>
				
					
						<form method="post" action="<?php echo site_url('main/send_contact');?>" id="sendmessage">
										<ul>
							<li><label>Message to seller</label><div><textarea name="contact" id="contact" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="id" value="<?php echo $id;?>">
								<li><div><input type="submit" value="Send Message" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	<div class="sidebar">
		<div id="sidebar_title">Browse by Category</div>
		<div class="sidebar_nav">
			<ul>
				<?php echo $category;?>
			</ul>
		</div>

		<div id="sidebar_title">Search</div>
		<form action="<?php echo site_url('service/search');?>" method="post">
		<table class="searchTable">
		<tr><td>
		 <input id="q" name="q" type="text" class="searchbar" /><input class="searchButton" type=submit id="Submit1"  value="Search" />
		</td>
		</tr>
		</table>

		</form>
		
		<div id="sidebar_title">Suggest a gig</div>
		<form action="" id="suggest_form" method="post"><div style="margin:0;padding:0;display:inline"></div>

		    <div class="suggest-form">
			      <label>I'm looking for someone who will</label>
		      <textarea class="suggestion-box" cols="25" id="suggest" rows="5"></textarea>
				<div class="errors-for-suggestions"></div>
		  		<input class="suggestButton" type=submit id="Submit1"  value="Suggest" />
		    </div>
		    </form>
		
		
	</div>
	
