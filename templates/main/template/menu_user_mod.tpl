<nav class="navbar navbar-mod" role="navigation">
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
                      <li><a href="{$url}index.php?controller=Photo&task=modulo_upload">Carica Foto</a></li>
                      <li><a href="{$url}index.php?controller=Login&task=logout">Logout</a></li>	
                      <li><a href="{$url}index.php?controller=Mod&task=modulo_banna">Banna Utenti</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="{$url}index.php?controller=Profilo&task=riepilogo">{$username}</a></li>
            </ul>
        </div>
    </div>
</nav>