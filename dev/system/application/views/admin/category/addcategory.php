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
			<h1 class="content_title"><a href="<?php echo site_url('admin/index');?>">Dashboard</a> &rarr; Add Category</h1><br/>
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
			<b>Add a category</b>


			<div id="dashboard">
				<div class="form-error"><?php echo validation_errors(); ?></div>
				<?php echo $this->session->flashdata('message'); ?>

				<form method="post" action="<?php echo site_url('admin/processcategory');?>" id="category">
									<ul>
						<li><label>Enter Category Name here</label><div><input type="text" name="category" id="category" class="text medium" value=""></div><span>Enter the name of the category you want to create here.</li>
								<li><label></label><div><input type="submit" value="Create Category"></div><span></li>
				</ul>
			</form>
		</div>

		</div>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



