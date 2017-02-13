<div class="table">
<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
	<tr class="contenuto">
			<td class="colonna foto">
			<table class="tabella" width="900px" align="center" cellpadding="5" cellspacing="0">
			<h3 class="title">Ultime foto caricate</h3>
			{for $iter_riga=1 to $MAX_RIGHE}
				<tr class="riga foto">
			 	{for $iter_colonna=1 to $MAX_COLONNE}
					<td class="colonna foto"><img src={array_ultime_foto[iter_colonna]}></td>
				{/for}
				</tr>
			{/for}
			</table>
			</td>
		<td class="colonna dati album" width="900px">
			<img src={$immagine_profilo}></td>
			<p><label for="Title" class="top">Username:</label< /br> {$utente.username}</label></p>
                        <p><label for="Title" class="top">email:</label< /br> {$utente.email}</label></p>
                        <p><label for="Title" class="top">Ruolo:</label< /br> {$utente.role}</label></p>
			
            <form>	
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
</div>
</table>