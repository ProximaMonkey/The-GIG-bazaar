<div id="content">
	
	<div class="listing">
		<h1 class="content_title">Services at prices you can afford</h1>
			 <h3>Edit details of the gig below</h3><br/>
			<?php echo $this->session->flashdata('message'); ?>
			 <form action="<?php echo site_url('service/modifygig');?>" method="post" enctype="multipart/form-data">
				<div class="iwill">
				<p>What are you willing to do for $5?</p>
				<div class="holder">
					<div class="txt">I will </div><div class="f"><input class="text" id="quicktitle" name="quicktitle" type="text" value="<?php echo $delete_details['title'];?>" /></div><div class="txt">for $5</div>
				</div>
				</div>
				<ul>
	<li><label>Category</label><div>				<select name="category"><?php echo $delete_details['category'];?>
						</select></div><span>Choose a category that best matches your gig to ensure successful review by our moderators</span></li>
						
			<li><label>Description</label><div><textarea name="jobdescription" id="area1" class="textarea medium msgpost"><?php echo $delete_details['description']; ?></textarea></div><span>			Be as descriptive as possible.

						Provide samples, what is required, what you will and will not do

						Define the extents of this gig - how many units, revisions, samples are included</span></li>
			
						<li><label>Keywords / Tags</label><div><textarea name="keywords" id="keywords" class="textarea " rows="5" cols="40"><?php echo $delete_details['tags']; ?></textarea></div><span>		Enter keywords that best describe your gig. Separate each tag by space

						Example: stickers social marketing promotion </span></li>

							<li><label>Maximum Days to complete</label><div><input type="text" name="maxdays" id="maxdays" class="text small" value="<?php echo $delete_details['maxnumofdays']; ?>"></div><span>Maximum days to complete the task</span></li>
							
								<li><label>What Information do you need to start this job?</label><div><textarea name="informationrequired" id="area2" class="textarea medium msgpost"><?php echo $delete_details['information_required']; ?></textarea></div><span>			Be as descriptive as possible.</span></li>
							
							<li><label>Gig Image</label><div><input type="file" name="gigimage" id="gigimage" class="text medium"></div><span>
							Image must be descriptive and relevant to your work
													510 pixels wide, 1Mb Max, Jpeg format
							</span></li>
							<input type="hidden" name="gig_id" value="<?php echo $delete_details['id'];?>">
								<li><label></label><div><input type="submit" class="ssubmit" value="Post"></div></li>
							
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
	
