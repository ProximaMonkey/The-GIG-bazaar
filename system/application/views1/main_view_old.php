<div id="content">
	
	<div class="listing">
		<?php echo $this->session->flashdata('message'); ?>
		<h1 class="content_title">Services at prices you can afford</h1>
			 	<?php
				if($this->session->userdata('logged_in') == TRUE)
				{
				?>
		<!-- I will -->
		 <form action="<?php echo site_url('service/postajob');?>" id="" method="post">
			<div class="iwill">
			<p>What are you willing to do for <?php echo CURRENCY." ".MINIMUM_BALANCE;?></p>
			<div class="holder">
				<div class="txt">I will </div><div class="f">
					<input class="text small" id="quicktitle" name="quicktitle" type="text" value="" /></div><div class="txt">for <?php echo CURRENCY." ".MINIMUM_BALANCE;?></div>
				<div class="img"><input type="submit" value="Continue" class="ssubmit"></div>
			</div>
		</div>
		</form>
		<?php
		}
		?>

		<div id="sort_filter">
			<div id="sort">Sort by</div> <a href="<?php echo site_url('service/filter/latest');?>">Latest</a> | <a href="<?php echo site_url('service/filter/mostviewed');?>">Most Viewed</a> 
			</div>
			<?php echo $gigs;?>
			
														<div class="pagination">
															<?php echo $pagination;?>
														</div>
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
	
	