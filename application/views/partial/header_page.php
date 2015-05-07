<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo $title;?></title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/base.css" type="text/css" media="screen" />
  <link rel="stylesheet" id="current-theme" href="<?php echo  base_url(); ?>assets/css/style.css" type="text/css" media="screen" />
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <script>
  $(function() {
      $( ".datepicker" ).datepicker();
  }); 

  </script>
    
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?> assets/js/jquery-1.3.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?> assets/js/jquery.scrollTo.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?> assets/js/jquery.localscroll.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8">
  $(document).ready(function(){
	    $("#radio_1").click(function(){
	        $("#date_1").hide();
	    });
	     $("#radio_2").click(function(){
	          $("#date_1").show();
	     });

	});
		
  </script>
    <script>
</script>
</head>
<body>
  <div id="container">
 <div id="header">
      <h1><a href="#">HRMS</a></h1>
      <div id="user-navigation">
	<?php echo $header_nav; ?>
        <!--<ul class="wat-cf">
          <li><a href="#">Profile</a></li>
          <li><a href="#">Settings</a></li>
          <li><a class="logout" href="#">Logout</a></li>
        </ul>-->
      </div>
      <div id="main-navigation">
        <font color = "white" >Human Resource Management System</font>
      </div>
    </div>
 
 <!--<div id="wrapper" class="wat-cf">
      <div id="main">-->
        
        