<script type="text/javascript"><!--//--><![CDATA[//><!--
startList = function() {
if (document.all&&document.getElementById) {
cssdropdownRoot = document.getElementById("menu");
for (x=0; x<cssdropdownRoot.childNodes.length; x++) {
node = cssdropdownRoot.childNodes[x];
if (node.nodeName=="LI") {
node.onmouseover=function() {
this.className+=" over";
}
node.onmouseout=function() {
this.className=this.className.replace(" over", "");
}
}
}
}
}

if (window.attachEvent)
window.attachEvent("onload", startList)
else
window.onload=startList;

//--><!]]></script>
<div id="content">
	
	<div class="listing">
		<h1 class="content_title"><a href="<?php echo site_url('admin/index');?>">Dashboard</a> &rarr; Approve a Gig</h1><br/>
		<ul id="menu">
		<li class="mainitems">
		<a href="">Gigs</a>
		<ul class="subuls" style="width: 15em">
		<li><a href="<?php echo site_url('admin/managegigs');?>">Manage gigs</a></li>
		</ul>
		</li>

		<li class="mainitems">
		<a href="">Category</a>
		<ul class="subuls" style="width: 15em">
		<li><a href="<?php echo site_url('admin/addcategory');?>">Add a Category</a></li>
		<li><a href="<?php echo site_url('admin/managecategory');?>">Manage Category</a></li>
		</ul>
		</li>
		
			<li class="mainitems">
			<a href="<?php echo site_url('admin/comments');?>">Comments</a>
			
			</li>
			
				<li class="mainitems">
				<a href="">Payments</a>
				<ul class="subuls" style="width: 15em">
				<li><a href="<?php echo site_url('admin/recentpayment');?>">Recent Payment</a></li>
				<li><a href="<?php echo site_url('admin/paymentreport');?>">Generate Reports</a></li>
				</ul>
				</li>
				
					<li class="mainitems">
					<a href="">Users</a>
					<ul class="subuls" style="width: 15em">
					<li><a href="<?php echo site_url('admin/approveuser');?>">Approve a User</a></li>
					<li><a href="<?php echo site_url('admin/manageuser');?>">Manage user</a></li>
					</ul>
					</li>
				
		</ul>

		<div id="restofcontent">
		<br />
		<b>Approve a Gig</b>
		
		
		<div id="dashboard">
		<small>Jobs awaiting to be approved</small><br/><br/>
		<?php echo $this->session->flashdata('message'); ?>
		<?php echo $jobs;?>
	</div>

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
		
	</div>
	
