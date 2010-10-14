<div id="content">
<div id="listing">

<div id="main-nav">
    	<ul>
	<li><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
		<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
	</ul>
   
	</div><!--main nav ends-->
    <?php $this->load->view('sidebar');?>



	<h1 class="content_title">Settings &rarr; Payment</h1>
	<ul id="menu">
	<li class="mainitems">
	<a href="<?php echo site_url('member/settings');?>">Edit Profile</a></li>
	<li class="highlight"><a href="<?php echo site_url('member/payment');?>">Payment</a></li>
	
	</ul>
	
			<div class="form-error"><?php echo validation_errors(); ?></div>
		<?php echo $this->session->flashdata('message'); ?>
		<form method="post" action="<?php echo site_url('member/updatepaypal');?>" id="updatepaypal">
							<ul>
										
				<li><label> PayPal Email Address</label><div><input type="text" name="paypalemail" id="paypalemail" class="text medium" value="<?php echo $member_detail['member_paypal']; ?>"></div><span>Email Address where we make the payment to</span></li>
			<li><div><input type="submit" value="update paypal address" name="submit" id="submit"></div> </li>
			</ul>
			</form>
			
			<h3>Withdraw Funds</h3><br/>
				<?php									
				if($withdraw['disabled'] == 1)
				{
					?>
					<ul>
				<li><label></label><div id='highlight'>Withdraw option is currently disabled for your account as your do not have enough balance</div></li>
				<br/><br/>
				<li><label>Current Balance</label><div><?php echo $withdraw['total_amount']?></div></li><br/><br/>
				<li><label>Minimum Required Balance</label><div><?php echo MINIMUM_BALANCE;?></div></li>
			</ul>
		<?php 
		}
		else {
		?>
		<?php echo $this->session->flashdata('payout'); ?>
				<form method="post" action="<?php echo site_url('member/requestpayout');?>" id="requestpayout">
									<ul>
										<li><label>Current Balance</label><div> <?php echo $withdraw['total_amount']?></div></li>
										
										<?php
										if($withdraw['error'] != "")
										{
										?>
										<li><label></label><div><?php echo $withdraw['error'];?></div></li>
							<?php
							}
							else {
								
							?>
								<li><label>Amount to withdraw</label><div><input type="text" name="amount" id="amount" class="text ssmall" value=""/><span>Minimum payout is $25.00</span></div></li>
							
			<li><div><input type="submit" value="update details" name="submit" id="submit" <?php echo $withdraw['submit']?>></div> </li>
							<?php
							}
							
							?>
								
							
		</ul>
	</form>
	<?php
	}
	?>

</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->
</div><!--content ends-->



