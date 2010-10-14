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
<script type='text/javascript' src='<?php echo base_url();?>/js/confirm.js'></script>
<script>
$(document).ready(function() {
    $('a#user_disabled').confirm({
        timeout:5000,
        dialogShow:'fadeIn',
        dialogSpeed:'slow',
        buttons: {
            wrapper:'<button></button>',
            separator:'  '
        }  
    });
		$('a#user_delete').confirm({
        timeout:5000,
        dialogShow:'fadeIn',
        dialogSpeed:'slow',
        buttons: {
            wrapper:'<button></button>',
            separator:'  '
        }  
    });
});
</script>
<div id="content">
<div id="listing">



<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('gig/favorite/'.$id);?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>



		<h1 class="content_title">Dashboard &rarr; Manage Users</h1><br/>
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
		<b>Welcome Administrator</b>
			<div id="dashboard">
			<small>Manage Users here</small><br/><br/>
			<?php echo $this->session->flashdata('message'); ?><br/><br/>
			<?php echo $user_manage;?>
		</div>
		
	
		</div>

</div><!--listing ends-->

<div class="clr"></div><!--clr ends-->
</div><!--content ends-->



