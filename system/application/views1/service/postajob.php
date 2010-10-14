 <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor({buttonList:['bold','italic','underline','ol','ul']}).panelInstance('area1');
        new nicEditor({buttonList:['bold','italic','underline','ol','ul']}).panelInstance('area2');
  });
  //]]>
  </script>
<div id="content">
<div id="listing">
<h2>Post a Gig</h2>

	<?php echo $error;?>
	<div class="form-error"><?php echo validation_errors(); ?></div>
		 <form action="<?php echo site_url('gig/addjob');?>" method="post" enctype="multipart/form-data">
			<div class="iwill">
			<p>What are you willing to do for <?php echo CURRENCY." ".MINIMUM_BALANCE;?>?</p>
			<div class="holder">
				<div class="txt">I will </div><div class="f"><input class="text" id="quicktitle" name="quicktitle" type="text" value="<?php echo set_value('quicktitle'); ?>" /></div><div class="txt">for <?php echo CURRENCY." ".MINIMUM_BALANCE;?></div>
			</div>
			</div>
			<ul>
<li><label>Category</label><div>				<select name="category"><?php echo $category_dropdown;?>
					</select></div><span>Choose a category that best matches your gig to ensure successful review by our moderators</span></li>
					
		<li><label>Description</label><div><textarea name="jobdescription" id="area1" class="textarea medium msgpost"><?php echo set_value('jobdescription'); ?></textarea></div><span>			Be as descriptive as possible.

					Provide samples, what is required, what you will and will not do

					Define the extents of this gig - how many units, revisions, samples are included</span></li>
		
					<li><label>Keywords / Tags</label><div><textarea name="keywords" id="keywords" class="textarea " rows="5" cols="40"><?php echo set_value('keywords'); ?></textarea></div><span>		Enter keywords that best describe your gig. Separate each tag by space

					Example: stickers social marketing promotion </span></li>

						<li><label>Maximum Days to complete</label><div><input type="text" name="maxdays" id="maxdays" class="text small" value="<?php echo set_value('maxdays'); ?>"></div><span>Maximum days to complete the task</span></li>
						
							<li><label>What Information do you need to start this job?</label><div><textarea name="informationrequired" id="area2" class="textarea medium msgpost"><?php echo set_value('informationrequired'); ?></textarea></div><span>			Be as descriptive as possible.</span></li>
						
						<li><label>Gig Image</label><div><input type="file" name="gigimage" id="gigimage" class="text medium"></div><span>
						Image must be descriptive and relevant to your work
												510 pixels wide, 1Mb Max, Jpeg format
						</span></li>
							<li><label></label><div><input type="submit" class="ssubmit" value="Post"></div></li>
						
		</ul>
		</form>


</div><!--listing ends-->
<div id="about-box">

<div class="padding">

<h2>The GiG Bazaar </h2>is a 
place for blah blah blah 
about us information is to 
come here.No registration,
 pay by indian credit cards
 or bank accounts easily. 
</div><!--padding ends-->

<div class="sublinks">
<ul>
<li><a href="#">about</a></li>
<li><a href="#">how it works</a></li>
</ul>
</div><!--sublink ends-->


</div><!--aboutbox ends-->

<div id="categories">

<h2 class="padding">Gig Categories</h2>
<ul>
	<?php echo $category;?>

</ul>
</li>
</div><!--categories ends-->
</div><!--content ends-->



