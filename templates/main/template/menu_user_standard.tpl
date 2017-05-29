<nav class="navbar navbar-standard" role="navigation">
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
                      <li><a href="{$url}index.php">Home</a></li>		
                      <li><a href="{$url}index.php?controller=photo&task=modulo_upload">Carica Foto</a></li>
                      <li><a href="{$url}index.php?controller=login&task=logout">Logout</a></li>	
                      <li><a href="fare una function per questo">Diventa Pro</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="{$url}index.php?controller=Profilo&task=riepilogo">{$username}</a></li>
            </ul>
        </div>
    </div>
</nav>