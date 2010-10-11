$(function(){
	$("a.save_gig").click(function(){
	//get the id
	the_id = $(this).attr('id');
	var current_count = $("span#savecount"+the_id).attr("class");
	// show the spinner
	//$(this).parent().html("<img src='images/spinner.gif'/>");
	
	//fadeout the vote-count 
	$("span#heart_icon"+the_id).fadeOut("fast");
	$("span#savecount"+the_id).fadeOut("slow");
	
	//the main ajax request
		$.ajax({
			type: "POST",
			data: "action=save_gig&id="+$(this).attr("id"),
			url: "http://dev.thegigbazaar.com/gig/save/",
			success: function(msg)
			{
				count = (parseInt(current_count)+1);
				$("span#heart_icon"+the_id).fadeIn();
				$("span#heart_icon"+the_id).html(msg);
				$("span#savecount"+the_id).fadeIn();
				$("span#savecount"+the_id).html(count);
				//fadein the vote count				
			
			}
		});
	});
	
});	
