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
<div id="listing">
	

		
		<b>Welcome Administrator</b>
			<h1 class="content_title"><a href="<?php echo site_url('admin/index');?>">Dashboard</a> &rarr; Edit Category</h1><br/>
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
			<b>Edit a category</b>


			<div id="dashboard">
				<div class="form-error"><?php echo validation_errors(); ?></div>
				<?php echo $this->session->flashdata('message'); ?>

				<form method="post" action="<?php echo site_url('admin/updatecategory');?>" id="category">
									<ul>
						<li><label>Edit Category Name</label><div><input type="text" name="category" id="category" class="text medium" value="<?php echo $name;?>"></div><span>Enter the new category name here.</li>
								<input type="hidden" name="categoryid" value="<?php echo $id?>">
								<li><label></label><div><input type="submit" value="Edit Category"></div><span></li>
				</ul>
			</form>
			</div>
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



