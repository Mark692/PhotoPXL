<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
			<td class="colonna foto">
			<table>
                            {foreach from=$ultime_foto item=array1}
                                <tr>
                                    {foreach from=$array1 item=valore}
                                        <td>
                                        <img src={$valore} width="100" height="100" >   
                                        </td>
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </table> 
			</td>
		<td class="colonna dati album" width="900px">
			<img src={$immagine_profilo}>
			<p><label for="Title" class="top">Username:</label< /br> {$utente.username}</label></p>
                        <p><label for="Title" class="top">email:</label< /br> {$utente.email}</label></p>
                        <p><label for="Title" class="top">Ruolo:</label< /br> {$utente.role}</label></p>
			
                        <form method="post" action="index.php">
                            <div class="pulsante">   
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="{$utente.username}">
                         <input type="hidden" name="email" value"{$utente.email}">
                         <input type="hidden" name="role" value"{$utente.role}">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="button" value="Modifica Profilo"/></p>
                        </div> 
                        </form>	
            
		</td>
	</tr>

</table>
</div>