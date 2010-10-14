<div id="content">
	
  <div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->  
    
    
	<div class="listing" style="margin-left:10px;">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
			<ul id="menu">
			<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
			<li class="highlight"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
			<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
			</ul>
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">You want to reject the order?</h1>
				<br/>
				<p>Leave a message for the buyer below and click "Notify Buyer" to notify the buyer that you will not be accepting the order.</p>
				
					
						<form method="post" action="<?php echo site_url('service/rejectmessage');?>" id="rejectmessage">
										<ul>
							<li><label>Message to buyer for rejecting the order.</label><div><textarea name="firstmessage" id="firstmessage" class="textarea medium"></textarea></div></li>
								<input type="hidden" name="orderid" value="<?php echo $orderid;?>">
								<li><div><input type="submit" value="Notify Buyer" name="submit" id="submit"></div> </li>
						</ul>
					</form>
			
	</div><!-- Listing -->
	
	<div class="sidebar" style="margin-left:20px;">
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
	
