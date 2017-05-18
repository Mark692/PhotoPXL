<?php /* Smarty version 2.6.30, created on 2017-05-17 13:06:48
         compiled from home_default.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Greeny Grass
Description: A two-column, fixed-width design.
Version    : 1.0
Released   : 20080208

-->

<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PhotoPXL</title>

    <!-- Bootstrap -->
    <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/main/template/css/Custom.css" rel="stylesheet">
   
  </head>
<body>
        <!-- start header -->

        <div id="header">
        <div id="logo">
        <img src="templates/main/template/img/logo.png" width="250" height="150" align="top"></img>
        </div>	
        <div>
            
            <?php echo $this->_tpl_vars['menu_user']; ?>

                    
        </div>
        <!-- end header -->
            
            <?php echo $this->_tpl_vars['banner']; ?>

            
        

<div id="page">
    
    <?php echo $this->_tpl_vars['content']; ?>

    
    <!--fine -->
</div>

  <!-- JS -->
  <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
  <script src="templates/main/template/js/bootstrap.min.js"></script>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
  <!-- JS -->
</body>