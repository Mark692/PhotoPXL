<?php /* Smarty version 2.6.30, created on 2017-02-16 13:54:20
         compiled from topbar_user.tpl */ ?>
<div id="topbar_standard">
		<h2>Benvenuto <?php echo $this->_tpl_vars['username']; ?>
</h2>
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
					<input id="user" type="hidden" name="username" value="<?php echo $this->_tpl_vars['username']; ?>
"/>
                                </ul>
</div>
			
sono il dio cane