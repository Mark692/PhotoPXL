<?php /* Smarty version 2.6.30, created on 2017-05-15 16:01:27
         compiled from menu_user_banned.tpl */ ?>
<nav class="navbar navbar-banned">
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">		
		<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php">Home</a></li>		
		<li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Login&task=logout">Logout</a></li>	
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Profilo&task=riepilogo"><?php echo $this->_tpl_vars['username']; ?>
</a></li>
      </ul>
  </div>
</nav>