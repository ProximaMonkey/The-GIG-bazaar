<div id="content">
<div id="listing">
	<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
		<ul id="menu">
		<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
		<li class="mainitems"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
		<li class="highlight"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
		</ul>
			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Gigs you ordered</h1>
		<?php echo $ordered;?>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



