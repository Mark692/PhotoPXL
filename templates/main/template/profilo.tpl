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
    