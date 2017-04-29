 <table>
        <tr>
            <td class="colonna" align="center">
        <div class="foto">
            <h3>Foto da mostrare</h3><br/>
                 <table>
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
        </div>
            <div class="descrizione">
                <p><label for="descrizione">descrizione del sito</label><br />
            </div>
        </td>
        <td class="colonna" align="center">
            <div class="modulo">
                <h2>Registrazione</h2>
                <form method="post" action="prova.php">
                      <p><label for="username">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="1" value="" /></p>
                      <p><label for="password">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="2" value="" /></p>
                      <p><label for="email">Email:</label><br />
                          <input type="text" name="email" class="input" tabindex="3" value="" /></p>
                      <p><input type="hidden" name="controller" value="registrazione" />
                          <input type="hidden" name="task" value="salva" />
                          <input type="submit" name="registrazione" class="button" value="Registrazione"  /></p>
                </form>
                <h2>Login</h2>
                <form method="post" action="index.php">
                      <p><label for="username">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="4" value="" /></p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="5" value="" /></p>
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /></p>
                </form>
            </div>
        </td>
    </tr>
</table>
