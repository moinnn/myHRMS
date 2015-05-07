<?php $this->load->view('partial/header_page.php');?>
        <title><?php echo $title;?></title>
    </head>
    <body bgcolor = "white">
        <center>
        <?php echo $body;?>
<br>
<p><a href ="<?php echo site_url('access');?>">SignIn</a> || <a href="<?php echo site_url('signup') ; ?>">Sign Up</a></p>
        </center>
</body>
    
</html>