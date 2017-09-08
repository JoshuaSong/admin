<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <title>VOU Admin</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/chrome-bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/icomoon.css"/> 
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/tables.css">

  <script src="<?php echo base_url(); ?>js/lib/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.form.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>js/lib/jquery.dataTables.columnFilter.js"></script>
<style>
	td{max-width: 300px; word-break:break-all; }
</style>
</head>
<body>
<div class="main">
	<div class="col_3">
		<ul class="menu-left">
			<li><a class="home" onClick="openPages('home')" href="#"><i class="icon-home-2"></i>Home</a></li>
			<li><a class="recipe-list" onClick="openPages('channel')" href="#"><i class="icon-list"></i>Channel</a></li>
			<li><a class="logout" onClick="openPages('program')" href="#"><i class="icon-volumefull"></i>Program</a></li>
			<li><a class="category" onClick="openPages('timeline')" href="#"><i class="icon-timeline"></i>Timeline</a></li>
			<li><a class="home" onClick="openPages('actor')" href="#"><i class="icon-user"></i>Actors</a></li>
			<li><a class="recipe-list" onClick="openPages('sitetouch')" href="#"><i class="icon-eye"></i>Site Touch</a></li>
			<li><a class="logout" onClick="openPages('programtouch')" href="#"><i class="icon-checkmark"></i>Program Touch</a></li>
			<li><a class="category" onClick="openPages('programshare')" href="#"><i class="icon-share"></i>Program Share</a></li>
			<li><a class="logout" onClick="openPages('comment')" href="#"><i class="icon-reply"></i>Comment</a></li>
			<li><a class="recipe-list" style="display: none;" onClick="openPages('recipe_list')" href="#"><i class="icon-food"></i>Recipe List</a></li>
			<li><a class="setting" onClick="openPages('user')" href="#"><i class="icon-uniF00F"></i>Setting</a></li>
			<li><a class="logout" href="login/logout"><i class="icon-muhamad-bahrul-ulum-log-out"></i>Logout</a></li>
		</ul>
	</div>
	<div class="col_9 padding-left">
		<div class="content-block">
    		<div class="content-block-title">VOU Admin Page</div>
			<div id="page"></div>
		</div>
	</div>
</div>
</body>
</html>

<script>
  
  // Default load page
  openPages("home");
  $('ul.menu-left li:first').addClass('selected');
   
   // Load page
  function openPages(url) {
  	$("#page").empty();	
  	$.ajax({
		url: url,	
		type: "GET",		
		cache: false,
		success: function (data) {	
			$("#page").html(data);		
			//$('#loading').fadeOut(100);
			}		
		});
	}	  
  
  // Set style active menu
  $('ul.menu-left li').click(function(){
    	$('.menu-left li').removeClass('selected');
    	$(this).addClass('selected');
  });

</script>