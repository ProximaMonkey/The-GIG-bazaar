<div id="content">
<div id="listing">
		<h1 class="content_title"><?php echo $gig['title'];?></h1><br/>
		<div id="gig_content">

	<img src="<?php echo base_url();?>/assets/timthumb.php?src=<?php echo base_url().'/images/gigs/'.$gig['image'];?>&h=100&w=100&zc=1\">
		<p><?php echo $gig['description'];?></p>
	</div>
	<div id="order_page"><a href="<?php echo site_url('gig/order/'.$id);?>"><div  class="order_nowbutton">Order now</div></a><br/>
		<a href='<?php echo site_url('main/contact/'.$person['id']);?>'><small>Contact Seller</small></a></div>
       		
					<div id="tags_page"> <div class="clr"></div><!--clr ends-->	Tags: <?php echo $gig['tags'];?> <div class="clr"></div><!--clr ends--></div>
                     
                    
					<div id="share"><b>Days to complete:</b> <?php echo $gig['maxnum'];?> days</div>
					<div id="subsection">
												<h3>Information Required for the Job</h3><br/>
												<?php echo $gig['information_required'];?>
					</div>
					<div id="subsection">
						<h3>About the Person</h3><br/>
						<img src="<?php echo base_url();?>/images/avatar.png" width="70" height="50" style="float:left;padding:9px;"> <h3><?php echo $person['name'];?><br/></h3>
					<p class="subtext"><?php echo $person['description'];?></p>
						
						</div>
					<div id="subsection">
						<h3>Reviews</h3><br/>
						<ol id='update' class='timeline'>
							<?php echo $reviews;?>
							</ol>
						<div id="flash"></div>
							<?php echo $this->session->flashdata('message'); ?>


									<?php
									if($this->session->userdata('logged_in') == TRUE)
									{
									?>
							<form method="post" action="<?php echo site_url('gig/comment');?>">
										<ul>
							<li><label>Write a review</label><div><textarea name="comment" id="comment" class="textarea medium" value=""></textarea></div></li>
							<input type="hidden" name="for_gig" value="<?php echo $id;?>">
							<li><label></label><div><input type="submit" name="submit" class="commentssubmit" value="Submit"></div></li>
								</ul>
								</form>
								<?php
							}
								?>

					</div>

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



