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
<script type="text/javascript" src="<?php echo base_url();?>js/ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ui.datepicker.js"></script>
<script type="text/javascript">
$(function() {
		$("#startdate").datepicker();
		$('#enddate').datepicker();
});
</script>
<link href="<?php echo base_url();?>css/datepicker.css" rel="stylesheet" type="text/css" media="all" />

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
		<li><a href="<?php echo site_url('main/favorite/');?>">most favorited</a> </li>  
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
			<div id="dashboard">
			<small>Payments</small><br/><br/>
			<form method='post' action='<?php echo site_url('admin/paypalreport');?>'>
			<?php echo $this->session->flashdata('message'); ?><br/><br/>
			<li><label>start Date</label><div>	<input type='text' name='startdate' id='startdate' class='text small'></div></li>
			<li><label>End Date</label><div>	<input type='text' name='enddate' class='text small' id='enddate' ></div></li>
				<input type="submit" value="Generate Report">
			</form>
		</div>
		
	
		</div>

</div><!--listing ends-->

<div class="clr"></div><!--clr ends-->
</div><!--content ends-->



