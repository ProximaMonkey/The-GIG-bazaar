$(function() {
$(".commentssubmit").click(function() 
{
var comment = $("#comment").val();
var dataString = 'comment=' + comment;
if(comment=='')
{
alert('Please enter some comments');
}
else
{
$("#flash").show();
$("#flash").fadeIn(400).html('<img src="ajax-loader.gif" />Loading Comment...');
$.ajax({
type: "POST",
url: "localhost:8888/fiverr/service/comment/",
data: dataString,
cache: false,
success: function(html){
$("ol#update").append(html);
$("ol#update li:last").fadeIn("slow");
$("#flash").hide();
}
});
}return false;
}); });
