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
                      <li><a href="index.php">Home</a></li>		
                      <li><a href="upload.php">Carica Foto</a></li>
                      <li><a href="create_album.php">Crea Album</a></li>
                      <li><a href="pro.php">Diventa Pro</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php" id="profile">{$username}</a></li>
                    <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>