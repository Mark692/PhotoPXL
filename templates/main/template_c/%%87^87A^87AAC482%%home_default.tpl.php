<?php /* Smarty version 2.6.30, created on 2017-05-10 13:28:15
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>PhotoPXL</title>

<link rel="stylesheet" type="text/css" media="screen,projection,print"  href="templates/main/template/style.css" />

</head>
<body>
        <!-- start header -->

        <div id="header">
        <div id="logo">
        <img src="templates/main/template/img/logo.png" width="250" height="150" align="top"></img>
        </div>	
                        
            <?php echo $this->_tpl_vars['menu_user']; ?>

                    
   
        </div>
        <!-- end header -->
            
            <?php echo $this->_tpl_vars['banner']; ?>

            
        
<table>
<tr>
<td>
<div id="page">
    
    <?php echo $this->_tpl_vars['content']; ?>

    
    <!--fine -->
</div>
    </td>
</tr>
</table>
</body>