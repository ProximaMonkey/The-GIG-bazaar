<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to Gigbazaar Beta</title>
<style type='text/css'>
html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, font, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td {
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	vertical-align: baseline;
	background: transparent;
}
body {
	line-height: 1;
}
body
{
	background-color:#FFF;
	font-family:Tahoma,Verdana, Geneva, sans-serif;
	color:#000;
	font-size:14px;
}

#wrapper
{
	margin:0 auto;
	padding: 50px 20% 0;
}

#logo {
	padding:15px;
}
#message {
	line-height:155%;	
}
#form {
	padding:10px;
	border:1px solid #333;
	margin-top:10px;
}
#code {
	padding:10px;
	width:300px;
	
}
#button {
background-color:#333;
color:#fff;
font-size:15px;
}

#error {
	font-size:15px;color:red;
}
#hasaccount {
	margin-top:15px;
}
#hasaccount span{
	background:#333;color:#fff;padding:5px;
}
#hasaccount a {
	color:#fff;
}
</style>
</head>
<body>
<div id="wrapper">

<div id='logo'>
	<img src='<?php echo base_url();?>images/logo.png'>
</div>
<div id='message'>Welcome to the beta version of thegigbazaar.com. Our system is currently being tested by beta testers and should be available soon for public access.<br/><br/>
	If you have a invite code, please enter it below.
</div>
<div id='error'>
<?php echo $this->session->flashdata('message');?>
</div>
<div id='form'>
	<form method='post' action="<?php echo site_url('beta/checkcode');?>">
		Invite Code <input type='text' name='code' id='code'/>
		<input type='submit' value='Let me in' id='button'>
	</form>
</div>
<div id='hasaccount'><span><a href='<?php echo site_url('beta/login');?>'>I have a beta account</a></span></div>
</div>
</body>
</html>