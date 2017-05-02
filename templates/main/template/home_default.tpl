<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Greeny Grass
Description: A two-column, fixed-width design.
Version    : 1.0
Released   : 20080208

-->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>PhotoPXL</title>

<link rel="stylesheet" type="text/css" media="screen,projection,print"  href="templates/main/template/style.css" />

</head>
<body>
        <!-- start header -->

        <div id="header">
        <div id="logo">
        <img src="templates/main/template/img/logo.png" width="250" height="150" align="top"></img>
        </div>	
                        <div id="navadmin">
				<ul>
                                 
                                        <li><a href="{$url}index.php">Home</a></li>		
					<li><a href="{$url}index.php?controller=profilo&task=dadefinere">Profilo</a></li>
					<li><a href="{$url}index.php?controller=upload&task=dadefinere">Carica Foto</a></li>
					<li><a href="{$url}index.php?controller=registrazione&task=logout">Logout</a></li>	
					<li><a href="fare una function per questo">Diventa Pro</a></li>
                                        <li><img src="templates/main/template/img/img08.jpg"></img>
                                </ul>
                        </div>
                    
   
        </div>
        <!-- end header -->
        
        
<table>
<tr>
<td>
<div id="page">
    
   
    
    

<table>
	<tr>
            <td class="colonna" align="center">
			<table>
                            {foreach from=$ultime_foto item=array1}
                                <tr>
                                    {foreach from=$array1 item=valore}
                                        <td>
                                        <img src="{$valore}" class="thumbnail" > 
                                        </td>
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </table> 
            </td>
		 <td class="colonna" align="center">
			<img src=""{$immagine_profilo}" class="thumbnail">
			<p><label for="Title"><h2>Username:</h2><br />{$utente.username}</label></p>
                        <p><label for="Title"><h2>Email:</h2><br />{$utente.email}</label></p>
                        <p><label for="Title"><h2>Ruolo:</h2><br />{$utente.role}</label></p>
			
                        <form method="post" action="index.php">  
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="{$utente.username}">
                         <input type="hidden" name="email" value"{$utente.email}">
                         <input type="hidden" name="role" value"{$utente.role}">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="button" value="Modifica Profilo"/></p>
                        </form>	
                 </td>
		
	</tr>

</table>
    
    
    
    
    
    <!--fine -->
</div>
    </td>
</tr>
</table>
</body>
