<div id="content">
	<?php $this->load->view('sidebar');?>
	<div class="listing">
		<h1 class="content_title">Welcome <?php echo $this->session->userdata('username');?></h1>
			<ul id="menu">
			<li class="mainitems"><a href="<?php echo site_url('member/gigs');?>">Gigs by you</a></li>
			<li class="highlight"><a href="<?php echo site_url('member/foryou');?>">Gigs for you</a></li>	
			<li class="mainitems"><a href="<?php echo site_url('member/ordered');?>">Gigs you ordered</a></li>				
			</ul>
				<?php echo $this->session->flashdata('message'); ?>
				<h1 class="page_title">Gig Delivered</h1>
				<br/>
				<p>We will let the buyer know about the gig being marked as completed and delivered.</p>
				<p>If there is no dispute raised, the money will be credited to your account in 15 days.<p>
					
				<p>
	</div><!-- Listing -->
	
