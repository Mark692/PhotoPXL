<?php /* Smarty version 2.6.30, created on 2017-04-07 13:50:21
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
	<div id="nav">
            <table>
                <tr>
                    <td>
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
                                        <li align="right"><a href="Profilo url"><?php echo 'federico'; ?>
</a></li>
                                </ul>
                    </td>
                                <td>
                                <ul>
                                    <li align="right"><a href="Profilo url"><?php echo 'federico'; ?>
</a></li>
                                </ul>
                                </td>
                </tr>
            </table>
        </div>
        </div>
        <!-- end header -->
        <div id="banner">
            <label id="banner_write">ciao</label>
        </div>
<table>
<tr>
    <td>
<div id="page">
    <table>
        <tr>
            <td width="750px" align="center">
        <div class="foto">
            <h3>Foto da mostrare</h3><br/>
                 <table>
                            <?php $_from = $this->_tpl_vars['thumbnail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['array1']):
?>
                                <tr>
                                <?php $_from = $this->_tpl_vars['array1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['valore']):
?>
                                    <td>
                                <img src=<?php echo $this->_tpl_vars['valore']; ?>
 width="100" height="100" > 
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                </table>           
        </div>
            <div class="descrizione">
                <p><label for="descrizione">descrizione del sito</label><br />
            </div>
        </td>
        <td width="750px" align="center">
            <div class="modulo">
                <h2>Registrazione</h2>
                <form method="post" action="prova.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="email" class="top">Email:</label><br />
                          <input type="text" name="email" class="input" tabindex="15" class="field" value="" /></p>
                      <p><input type="hidden" name="controller" value="registrazione" />
                          <input type="hidden" name="task" value="salva" />
                          <input type="submit" name="registrazione" class="button" value="Registrazione"  /></p>
                </form>
                <h2>Login</h2>
                <form method="post" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="15" class="field" value="" /></p>
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /></p>
                </form>
            </div>
        </td>
    </tr>
</table>
</div>
    </td>
</tr>
</table>
</div>
</body>