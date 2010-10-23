<?php
$from = "INR";
$to = "USD";
$amount = 500;
$url = "http://www.exchangerate-api.com/".$from."/".$to."/".$amount."?k=qfQqE-xzg67-N4hOa";
$result = file_get_contents($url);
$percent = number_format((($result * 3) / 100),2);
$final = number_format($result,2)+$percent;
?>
<script type="text/javascript"> 
$(document).ready( function() {
$('#paypal_form').submit();
});
</script>
<div id="content">
	<?php $this->load->view('sidebar');?>
<div id="listing">
		<h1 class="content_title">Order Gig - <?php echo $title;?> </h1><br/>
	<b>You are being redirected to payment gateway</b>
	<form action="https://www.paypal.com/cgi-bin/webscr" id="paypal_form" method="post">
		<input type='hidden' name='amount' value='<?php echo $final?>'>
		<input type='hidden' name='item_name' value='<?php echo $title;?>'>
		<input type='hidden' name='item_number' value='<?php echo $orderid;?>'>
		<input type='hidden' name='image_url' value='http://dev.thegigbazaar.com/images/logo.png'>
		<INPUT TYPE="hidden" NAME="return" value="<?php echo site_url('gig/placeorder/');?>/">
			<INPUT TYPE="hidden" NAME="cancel_return" value="<?php echo site_url('gig/cancelled');?>">
			<INPUT TYPE="hidden" NAME="currency_code" value="USD">
				<input type="hidden" name="business" value="cybersuni@gmail.com">  
				<input id="cmd" name="cmd" type="hidden" value="_xclick" />
				<input type="hidden" name="rm" value="2">
		<input type='submit' value='Redirecting to payment gateway...please wait'>
	</form>	

</div><!--listing ends-->

</div><!--content ends-->



