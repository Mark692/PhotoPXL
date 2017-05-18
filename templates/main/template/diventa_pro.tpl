<div class="container">
    <div class="row">
    <div class="col-md-6">
		<table>
                            {foreach from=$thumbnail item=array1}
                                <tr>
                                {foreach from=$array1 item=valore}
                                    <td>
                                <img src="{$valore}" class="thumbnail" > <!-- sistemare il css per le thumb -->
                                    </td>
                                {/foreach}
                                </tr>
                            {/foreach}
                </table>  
    </div>
    <div class="col-md-6">
		
                    <h1 class="text-success">Diventa Pro Adesso!!!</h1>
                    <p> <label>I vantaggi nel diventare PRO:</label></ br>
                    <ul>
                        <li>Potrai caricare foto illimitate</li>
                        <li>Potrai impostare la visibilità delle tue foto e album</li>
                        <li>Potrai caricare fino a 3 foto contemporaneamente</li>
                    </ul>
                    <form method="POST" action="index.php">
                    <p><input type="hidden" name="controller" value="Profilo" />
                       <input type="hidden" name="task" value="Cambia_ruolo" />
                       <input type="submit" name="cerca" class="btn-success" value="Diventa Pro"  /></p>
                    </form>
    </div>
    </div>
</div>