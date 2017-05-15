<nav class="navbar navbar-pro">
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
                <li><a href="{$url}index.php">Home</a></li>		
                <li><a href="{$url}index.php?controller=photo&task=modulo_upload">Carica Foto</a></li>
		<li><a href="{$url}index.php?controller=login&task=logout">Logout</a></li>	
      </ul>
      <ul class="nav navbar-nav navbar-right">
              <li><a href="{$url}index.php?controller=Profilo&task=riepilogo">{$username}</a></li>
      </ul>
  </div>
</nav>