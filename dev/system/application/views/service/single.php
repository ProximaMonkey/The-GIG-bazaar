<div id="content">
<div id="listing">
<div id="main-nav">
<ul>
<li><a href="<?php echo site_url('main/index');?>">hot</a></li>
<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
</ul>
</div><!--main nav ends-->
<?php $this->load->view('sidebar');?>
<div id="main-content">
		<h1 class="content_title"><?php echo $gig['title'];?></h1><br/>
		<div id="gig_content">
        
<div id="order_page"><a href="<?php echo site_url('gig/order/'.$id);?>"><div  class="order_nowbutton">Order now</div></a><br/>
		<a href='<?php echo site_url('main/contact/'.$person['id']);?>'><small>Contact Seller</small></a></div>

	<img src="<?php echo base_url();?>/assets/timthumb.php?src=<?php echo base_url().'/images/gigs/'.$gig['image'];?>&h=100&w=100&zc=1\">
		<p><?php echo $gig['description'];?></p>
        <div class="clearleft"	></div>
        </div><!--gig_content ends-->
    
	   		
					<div id="tags_page">Tags: <?php echo $gig['tags'];?> </div>
                     
                    
					<b>Days to complete:</b> <?php echo $gig['maxnum'];?> days
					<div id="share">
					<!-- AddThis Button BEGIN -->
					<div class="addthis_toolbox addthis_default_style">
					<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4c63e12c336a76f5" class="addthis_button_compact">Share</a>
					<span class="addthis_separator">|</span>
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_myspace"></a>
					<a class="addthis_button_google"></a>
					<a class="addthis_button_twitter"></a>
                    <div class="clr"></div>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4c63e12c336a76f5"></script>
					<!-- AddThis Button END -->
                    </div>
                    
					<div class="subsection">
												<h3>Information Required for the Job</h3><br/>
												<?php echo $gig['information_required'];?>
					</div>
					<div class="subsection">
						<h3>About the Seller</h3><br/>
						<img src="<?php echo base_url();?>/images/<?php echo $person['image'];?>" width="70" height="50" style="float:left;padding:9px;"> <h3><?php echo $person['name'];?><br/></h3>
					<p class="subtext"><?php echo $person['description'];?></p>
						
						</div>
					<div class="subsection">
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
</div><!--main content ends-->
</div><!--listing ends-->

</div><!--content ends-->



