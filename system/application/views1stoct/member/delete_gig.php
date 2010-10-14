<div id="content">
	
   <div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends--> 
    
    
	<div class="listing" style="margin-left:20px;">
		<h1 class="content_title">Services at prices you can afford</h1>
			 <h3>Are you sure you want to delete this gig? There is no going back</h3><br/>
			<?php echo $this->session->flashdata('message'); ?>
			<?php echo $delete_details;?>
			
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
	
