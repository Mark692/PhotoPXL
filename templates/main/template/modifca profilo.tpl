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
		<form class="modulo" action="index.php">
			<img src={$immagine_profilo}></td> {*trovare un modo per modificare l'immagine profilo*}
			<p><label for="Title" class="top">Username:< /br> </label>
			<input type="text" name="Username" id="title" class="field" value="{$utente.username}"/></p>
			<p><label for="Title" class="top">Password:< /br> </label>
			<input type="Password" name="title" id="title" class="field" value="{$utente.password}"/></p>
			<p><label for="Title" class="top">email:< /br></label>
			<input type="text" name="email" id="title" class="field" value="{$utente.email}"/></p>
			<p><label for="Title" class="top">Ruolo:< /br> {$utente.role}</label></p>
			<div class="pulsante"
                      <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden" name="task" value="update" />
                         <input type="submit" name="Salva" class="button" value="Salva Modifiche"/></p>
                </div>
            </form>
            
		</td>
	</tr>
</div>
</table>