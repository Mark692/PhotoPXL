<?php /* Smarty version 2.6.30, created on 2017-05-15 16:03:49
         compiled from menu_user_standard.tpl */ ?>
<nav class="navbar navbar-standard">
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
                <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php">Home</a></li>		
		<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=photo&task=modulo_upload">Carica Foto</a></li>
		<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=login&task=logout">Logout</a></li>	
		<li><a href="fare una function per questo">Diventa Pro</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Profilo&task=riepilogo"><?php echo $this->_tpl_vars['username']; ?>
</a></li>
      </ul>
  </div>
</nav>