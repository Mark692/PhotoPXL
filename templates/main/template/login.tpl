<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
        <td class="colonna1" width="900px" align="center">
            <fieldset>
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
                <p><label for="descrizione" class="top">descrizione del sito</label></p>
            </div>
        </td>
        <td class="colonna login" width="900px" align="center">
            <h1 class="title">Login</h1>
            <div class="modulo">
            <form method="post" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" id="username" tabindex="15" class="field" value="" />
                      </p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" id="password" tabindex="15" class="field" value="" /></p>
                      <div class="pulsante"
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /> </p>
                      </div>
            </form>
            </div>
        </td>
    </tr>
</table>

