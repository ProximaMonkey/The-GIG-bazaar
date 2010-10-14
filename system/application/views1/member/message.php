<div id="content">
<div id="listing">
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
<div id="about-box">

<div class="padding">

<h2>The GiG Bazaar </h2>is a 
place for blah blah blah 
about us information is to 
come here.No registration,
 pay by indian credit cards
 or bank accounts easily. 
</div><!--padding ends-->

<div class="sublinks">
<ul>
<li><a href="#">about</a></li>
<li><a href="#">how it works</a></li>
</ul>
</div><!--sublink ends-->


</div><!--aboutbox ends-->

<div id="categories">

<h2 class="padding">Gig Categories</h2>
<ul>
	<?php echo $category;?>

</ul>
</li>
</div><!--categories ends-->
</div><!--content ends-->



