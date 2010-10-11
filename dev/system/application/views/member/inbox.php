<div id="content">
<div id="listing">
	<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>

			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Inbox</h1>
			<form method='post' action='<?php echo site_url('member/delete');?>'>
		<?php echo $inbox;?>
	
		</form>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



