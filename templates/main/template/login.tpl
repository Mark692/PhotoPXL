<table>
    <tr >
        <td class="colonna" align="center">
                <table>
                    {foreach from=$ultime_foto item=array1}
                        <tr>
                            {foreach from=$array1 item=valore}
                                <td>
                                    <img src="{$valore}" class="thumbnail">  
                                </td>
                            {/foreach}
                        </tr>
                    {/foreach}
                </table> 
                <p><label for="descrizione" class="top">descrizione del sito</label></p>
        </td>
        <td class="colonna" align="center">
            <h1 class="title">Login</h1>
            <form method="POST" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" value="" />
                      </p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" value="" /></p>
                      
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /> </p>
            </form>
            </div>
        </td>
    </tr>
</table>

