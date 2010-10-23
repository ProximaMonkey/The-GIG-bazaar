<div id="content">
<div id="listing">
<?php $this->load->view('sidebar');?>
	<h2>Read Message</h2>

			<?php echo $this->session->flashdata('message'); ?>

            
		<br/>
        <h2 style='color:green'>subject : <?php echo $message['subject'];?></p></h2>
        <br/>
		<p><?php echo $message['message'];?></p>
		<br/><br/>
		<b>Replies:<br/>
		<?php echo $replies;?>
		<hr>
		<?php
		if($message['reply'] == 'active')
		{
		?>
		<form method='post' action="<?php echo site_url('member/reply');?>">
		<input type='hidden' value='<?php echo $message['id'];?>' name='messageid'>
			<ul>
				<li><label>Reply</label><div><textarea name="replymessage" id="replymessage" class="textarea medium"></textarea></div></li>		
				<li><div><input type="submit" value="Send Message" name="submit" id="submit"></div> </li>
			</ul>
		</form>
		<?php
		}
		?>

</div><!--listing ends-->
<div class="clr"></div><!--clr ends-->

</div><!--content ends-->



