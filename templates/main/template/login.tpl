<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
        <td class="colonna1" width="900px" align="center">
            <fieldset>
            <div class="foto">
                <table class="tabella" width="900px" align="center" cellpadding="5" cellspacing="0">
                            {for $iter=1 to $MAX_RIGHE}
                                <tr class="riga foto">
                                    {for $iter=1 to $MAX_COLONNE}
                                        <td class="colonna foto"><img src={$dati_foto.images[]}></td>
                                {/for}
                                </tr>
                            {/for}
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

