<nav class="navbar navbar-admin">
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
              <li><a href="{$url}index.php">Home</a></li>   
              <li><a href="{$url}index.php?controller=Photo&task=modulo_upload">Carica Foto</a></li>
              <li><a href="{$url}index.php?controller=Login&task=logout">Logout</a></li>  
              <li><a href="{$url}index.php?controller=amministratore&task=modulo_banna">Banna Utenti</a></li>
              <li><a href="{$url}index.php?controller=amministratore&task=modulo_cambia_ruolo">Cambia Ruoli</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="{$url}index.php?controller=Profilo&task=riepilogo">{$username}</a></li>
      </ul>
  </div>
</nav>