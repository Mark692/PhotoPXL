<table>
                    <tr>
			<td class="colonna" align="center">
			<table cellpadding="5" cellspacing="2">
                            {foreach from=$thumbnail item=array1}
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
		</td>
		<td class="colonna" align="center">
		<form class="modulo" action="index.php">
			<img src="{$immagine_profilo}" class="thumbnail">
                        <div class="pulsante"
                            <p><input type="hidden" name="controller" value="profilo" />
                             <input type="hidden" name="task" value="update" />
                             <input type="submit" name="Salva" class="button" value="Modifica"/></p>
                        </div>
			<p><label for="Title">Username:</ br> </label>
			<input type="text" name="Username" id="title" value="{$utente.username}"/></p>
			<p><label for="Title">Password:</ br> </label>
			<input type="Password" name="title" id="title" value="{$utente.password}"/></p>
			<p><label for="Title">email:</ br></label>
			<input type="text" name="email" id="title" value="{$utente.email}"/></p>
			<p><label for="Title">Ruolo:</ br> {$utente.role}</label></p>
			<div class="pulsante"
                      <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden" name="task" value="update" />
                         <input type="submit" name="Salva" class="button" value="Salva Modifiche"/></p>
                </div>
            </form>
            
		</td>
	</tr>

    </table>
</div>