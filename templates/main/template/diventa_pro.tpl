<table align="center">
    <tr>
	<td>
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
    <td width="900px">
		
                    <h1>Diventa Pro Adesso!!!</h1>
                    <p><label>I vantaggi nel diventare PRO:</label></ br>
                    <ul>
                            <li>Potrai caricare foto illimitate</li>
                            <li>Potrai impostare la visibilità delle tue foto e album</li>
                            <li>Potrai caricare fino a 3 foto contemporaneamente</li>
                    </ul>
                    <form method="POST" action="index.php">
                            <p><input type="hidden" name="controller" value="Profilo" />
                            <input type="hidden" name="task" value="Cambia_ruolo" />
                            <input type="submit" name="cerca" class="button" value="Diventa Pro"  /></p>
                    </form>
            </div>
	</td>
    </tr>
</table>