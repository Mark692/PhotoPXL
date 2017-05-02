<?php /* Smarty version 2.6.30, created on 2017-05-02 14:38:53
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
                        <div id="navadmin">
				<ul>
                                 
                                        <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php">Home</a></li>		
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=profilo&task=dadefinere">Profilo</a></li>
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=upload&task=dadefinere">Carica Foto</a></li>
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=registrazione&task=logout">Logout</a></li>	
					<li><a href="fare una function per questo">Diventa Pro</a></li>
                                        <li><img src="templates/main/template/img/img08.jpg"></img>
                                </ul>
                        </div>
                    
   
        </div>
        <!-- end header -->
        
        
<table>
<tr>
<td>
<div id="page">
    
   
    
    

<table>
	<tr>
            <td class="colonna" align="center">
			<table>
                            <?php $_from = $this->_tpl_vars['ultime_foto']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                                <tr>
                                    <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                        <td>
                                        <img src="<?php echo $this->_tpl_vars['valore']; ?>
" class="thumbnail" > 
                                        </td>
                                    <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table> 
            </td>
		 <td class="colonna" align="center">
			<img src=""<?php echo $this->_tpl_vars['immagine_profilo']; ?>
" class="thumbnail">
			<p><label for="Title"><h2>Username:</h2><br /><?php echo $this->_tpl_vars['utente']['username']; ?>
</label></p>
                        <p><label for="Title"><h2>Email:</h2><br /><?php echo $this->_tpl_vars['utente']['email']; ?>
</label></p>
                        <p><label for="Title"><h2>Ruolo:</h2><br /><?php echo $this->_tpl_vars['utente']['role']; ?>
</label></p>
			
                        <form method="post" action="index.php">  
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="<?php echo $this->_tpl_vars['utente']['username']; ?>
">
                         <input type="hidden" name="email" value"<?php echo $this->_tpl_vars['utente']['email']; ?>
">
                         <input type="hidden" name="role" value"<?php echo $this->_tpl_vars['utente']['role']; ?>
">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="button" value="Modifica Profilo"/></p>
                        </form>	
                 </td>
		
	</tr>

</table>
    
    
    
    
    
    <!--fine -->
</div>
    </td>
</tr>
</table>
</body>