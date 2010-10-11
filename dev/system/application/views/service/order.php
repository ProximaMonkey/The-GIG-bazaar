<div id="content">
<div id="listing">
		<h1 class="content_title">Order Gig - <?php echo $title;?> </h1><br/>
	<p>
	Please enter your payment details below
	</p>

	<div id="box">
		<div id="title">Payment Details</div>

			<form method="post" action="<?php echo site_url('gig/placeorder');?>" id="placeorder">
								<ul>
					<li><label>Name on Card</label><div><input type="text" name="nameoncard" id="nameoncard" class="text medium" value=""></div></li>
					<li><label>Credit Card Number</label><div><input type="text" name="cardnumber" id="cardnumber" class="text medium" value=""></div></li>
					<li><label>CVV</label><div><input type="password" name="cvv" id="cvv" class="text ssmall" value=""></div></li>
					<li><label>Expiry Date</label><div><input type="text" name="month" id="month" class="text ssmall" value=""><input type="text" name="year" id="year" class="text ssmall" value=""></div><span>Month / Year</span></li>
					<input type="hidden" value="<?php echo $orderid;?>" name="orderid">
					<li><div><input type="submit" value="Place Order" name="submit" id="submit" class="submit"></div> </li>

			</ul>
		</form>

	</div>

</div><!--listing ends-->
<?php $this->load->view('sidebar');?>
</div><!--content ends-->



