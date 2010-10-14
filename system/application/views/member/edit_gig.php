<div id="content">
	
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Services at prices you can afford</h1>
			 <h3>Edit details of the gig below</h3><br/>
			<?php echo $this->session->flashdata('message'); ?>
			 <form action="<?php echo site_url('gig/modifygig');?>" method="post" enctype="multipart/form-data">
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
			
							<li><label>Keywords / Tags</label><div><input type='text' class='text ssmall' name='tag1' maxlength='10' value="<?php echo $delete_details['tag1'];?>"><input type='text' class='text ssmall' name='tag2' maxlength='10' value="<?php echo $delete_details['tag2'];?>"><input type='text' class='text ssmall' name='tag3' maxlength='10' value="<?php echo $delete_details['tag3'];?>"><input type='text' class='text ssmall' name='tag4' maxlength='10' value="<?php echo $delete_details['tag4'];?>"><input type='text' class='text ssmall' name='tag5' maxlength='10' value="<?php echo $delete_details['tag5'];?>"></div><span>Enter keywords that best describe your gig.
							Example: stickers social marketing promotion </span></li>

						Example: stickers social marketing promotion </span></li>

							<li><label>Maximum Days to complete</label><div><input type="text" name="maxdays" id="maxdays" class="text small" value="<?php echo $delete_details['maxnumofdays']; ?>"></div><span>Maximum days to complete the task</span></li>
							
								<li><label>What Information do you need to start this job?</label><div><textarea name="informationrequired" id="area2" class="textarea medium msgpost"><?php echo $delete_details['information_required']; ?></textarea></div><span>			Be as descriptive as possible.</span></li>
							
							<li><label>Gig Image</label><div><input type="file" name="gigimage" id="gigimage" class="text medium"></div><span>
							Image must be descriptive and relevant to your work
													510 pixels wide, 1Mb Max, Jpeg format
							</span></li>
							<input type="hidden" name="gig_id" value="<?php echo $delete_details['id'];?>">
								<li><label></label><div><input type="submit" class="ssubmit" value="Edit Details"></div></li>
							
			</ul>
			</form>
			
	</div><!-- Listing -->

	
