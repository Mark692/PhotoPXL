<?php /* Smarty version 2.6.30, created on 2017-05-12 11:47:36
         compiled from menu_user_admin.tpl */ ?>
<div id="navadmin">
		
				<ul>
                                    <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php">Home</a></li>		
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Photo&task=modulo_upload">Carica Foto</a></li>
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Login&task=logout">Logout</a></li>	
					<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=amministratore&task=modulo_banna">Banna Utenti</a></li>
                                        <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=amministratore&task=modulo_cambia_ruolo">Cambia Ruoli</a></li>
                                        <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Profilo&task=riepilogo"><?php echo $this->_tpl_vars['username']; ?>
</a></li>
                                        <li><img src="immagine con scritto admin"></li>
                                </ul>
</div>