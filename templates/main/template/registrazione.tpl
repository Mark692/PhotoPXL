<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
        <td class="colonna1" width="900px" align="center">
            <div class="ultime foto">
                <p>Foto del momento<br/></p>
                        <table class="colonna foto" cellpadding="5" cellspacing="2">
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
                <p><label for="descrizione" class="top">descrizione del sito</label><br />
            </div>
        </td>
        <td class="colonna" width="900px" align="center">
            <h1 class="title">Registrazione</h1>
                <div class="modulo">
                    <form method="post" action="prova.php">
                          <p><label for="username" class="top">Nome utente:</label><br />
                              <input type="text" name="username" tabindex="15" class="field" value="" /></p>
                          <p><label for="password" class="top">Password:</label><br />
                              <input type="password" name="password" tabindex="15" class="field" value="" /></p>
                          <p><label for="email" class="top">Email:</label><br />
                              <input type="text" name="email"  tabindex="15" class="field" value="" /></p>
                          {*<p><label for="foto_profilo" class="top">Inserisci una foto profilo:</label><br />
                              <input type="file" name="foto_profilo" id="foto_profilo" class="field" value=""></p>*}
                          <p><input type="hidden" name="controller" value="registrazione" />
                          <p><input type="hidden" name="task" value="salva" />
                          <p><input type="submit" name="registrazione" class="button" value="Registrazione"  /></p>
              </form>
        </div>
        </td>
    </tr>
</table>
v