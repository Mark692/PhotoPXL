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
		<form metod="POST" action="index.php">
			<img src="{$user_details.pic}" class="thumbnail">
                            <input type="hidden" name="controller" value="profilo" />
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Modifica"/>
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value="{$user_details.username}">
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value="{$user_details.password}">
                            </div>
                            <h3 class="text-success">Email:</h3><br />
                            <div class="form-group">
                                <input class="form-control" id="focusedInput" type="text" value="{$user_details.email}">
                            </div>
                            <h3 class="text-success">Ruolo:</h3><br />{$user_details.role}
                            <input type="hidden" name="controller" value="profilo" />
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Salva Modifiche"/>
                </form>
    </div>
    </div>
</div>