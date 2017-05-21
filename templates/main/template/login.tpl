<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h1 class="text-success">Foto da mostrare</h1><br/>
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
                        <p><label for="descrizione">descrizione del sito</label><br />
    </div>
    <div class="col-md-6">
                <h1 class="text-success">Login</h1>
                <form method="post" action="index.php">
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input name="username" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input name="password" class="form-control" id="focusedInput" type="password" value="">
                            </div>
                            <input type="hidden" name="controller" value="login" />
                            <input type="hidden" name="task" value="login" />
                            <input type="submit" name="login" class="btn-success" value="Login"  /></p>
                </form>
    </div>
    </div>
</div>
