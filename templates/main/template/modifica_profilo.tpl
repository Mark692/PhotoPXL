<div class="table">
    <table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0">
	<tr class="contenuto">
		<td class="colonna foto">
			<div class="foto">
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
                        </div>
		</td>
		<td class="colonna dati album" width="900px">
		<form class="modulo" action="index.php">
			<img src={$immagine_profilo}>
                        <div class="pulsante"
                            <p><input type="hidden" name="controller" value="profilo" />
                             <input type="hidden" name="task" value="update" />
                             <input type="submit" name="Salva" class="button" value="Modifica"/></p>
                        </div>
			<p><label for="Title" class="top">Username:</ br> </label>
			<input type="text" name="Username" id="title" class="field" value="{$utente.username}"/></p>
			<p><label for="Title" class="top">Password:</ br> </label>
			<input type="Password" name="title" id="title" class="field" value="{$utente.password}"/></p>
			<p><label for="Title" class="top">email:</ br></label>
			<input type="text" name="email" id="title" class="field" value="{$utente.email}"/></p>
			<p><label for="Title" class="top">Ruolo:</ br> {$utente.role}</label></p>
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