<div id="content">
<div id="listing">
<?php $this->load->view('sidebar');?>
	<h2>Read Message</h2>

			<?php echo $this->session->flashdata('message'); ?>
			<h1 class="page_title">Message</h1>
		<p><?php echo $message['message'];?></p>
		
		<b>Replies:<br/>
		<?php echo $replies;?>
		<?php
		if($message['reply'] == 'active')
		{
		?>
		<form method='post' action="<?php echo site_url('member/reply');?>">
		<input type='hidden' value='<?php echo $message['id'];?>' name='messageid'>
			<ul>
				<li><label>Reply</label><div><textarea name="replymessage" id="replymessage" class="textarea medium"></textarea></div></li>		
				<li><div><input type="submit" value="Notify Buyer" name="submit" id="submit"></div> </li>
			</ul>
		</form>
		<?php
		}
		?>

</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->

</div><!--content ends-->



