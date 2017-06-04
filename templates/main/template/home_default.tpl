<!DOCTYPE html>
<html lang="it">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PhotoPXL</title>

    <!-- Bootstrap -->
    <link href="templates/main/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="templates/main/template/css/Custom.css" rel="stylesheet">
   
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="templates/main/template/js/sha512.js"></script>
  </head>
<body>
        <!-- start header -->

        <div id="header">
        <div id="logo">
        <img src="templates/main/template/img/logo.png" width="250" height="150" align="top"></img>
        </div>	
        <div>

            {$menu_user}
        </div>
        <!-- end header -->
            
            {$banner|default:"&nbsp;"}
            
        <div>
    
            {$mainContent}
    
    <!--fine -->
        </div>
</body>
