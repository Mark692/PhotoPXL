<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
    <tr class="contenuto">
        <td class="colonna1" width="900px" align="center">
            <div class="ultime foto">
                <p>Foto del momento<br/></p>
                        <table class="tabella" width="900px" align="center" cellpadding="5" cellspacing="0">
                                    {for $iter=1 to $MAX_RIGHE}
                                            <tr class="riga foto">
                                            {for $iter=1 to $MAX_COLONNE}
                                                    <td class="colonna foto"><img src={$dati_foto.images[]}></td>
                                            {/for}
                                            </tr>
                                    {/for}
                        </table>
                <p><label for="descrizione" class="top">descrizione del sito</label><br />
            </div>
        </td>
        <td class="colonna" width="900px" align="center">
            <h1 class="title">Registrazione</h1>
                <div class="modulo">
                    <form method="post" action="index.php">
                          <p><label for="username" class="top">Nome utente:</label><br />
                              <input type="text" name="username" id="username" tabindex="15" class="field" value="" /></p>
                          <p><label for="password" class="top">Password:</label><br />
                              <input type="password" name="password" id="password" tabindex="15" class="field" value="" /></p>
                          <p><label for="email" class="top">Email:</label><br />
                              <input type="text" name="email" id="email" tabindex="15" class="field" value="" /></p>
                          <p><label for="foto_profilo" class="top">Inserisci una foto profilo:</label><br />
                              <input type="file" name="foto_profilo" id="foto_profilo" class="field" value=""></p>
                          <p><input type="hidden" name="controller" value="registrazione" />
                          <p><input type="hidden" name="task" value="salva" />
                          <p><input type="submit" name="registrazione" class="button" value="Registrazione"  /></p>
              </form>
        </div>
        </td>
    </tr>
</table>
