<?php /* Smarty version 2.6.30, created on 2017-05-17 13:32:17
         compiled from menu_user_admin.tpl */ ?>
<nav class="navbar navbar-admin" role="navigation">
<div class="container-fluid">
<div class="navbar-header">

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Espandi barra di navigazione</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
</div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="<?php echo $this->_tpl_vars['url']; ?>
index.php?controller=Profilo&task=riepilogo"><?php echo $this->_tpl_vars['username']; ?>
</a></li>
      </ul>
  </div>
</div>
</nav>