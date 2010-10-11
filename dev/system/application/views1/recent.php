<div id="content">
<div id="listing">

<div id="main-nav">
<ul>
<li><a href="<?php echo site_url('main/index');?>">hot</a></li>
<li><a href="<?php echo site_url('main/favorite');?>">most favorited</a> </li>  
<li class="selected"><a href="<?php echo site_url('main/recent');?>">recent</a> </li>
</ul>
</div><!--main nav ends-->
<?php echo $gigs;?>
<div class="pagination">
	<?php echo $pagination;?>
</div>
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



