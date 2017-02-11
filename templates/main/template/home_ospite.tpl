<table class="tabella" align="center" border="3" cellpadding="5" cellspacing="0">
<tr class="contenuto">
<td class="colonna1" width="900px" align="center">
<fieldset>
<div class="foto">
<p>Foto da mostrare<br/><img src="foto a caso">
</p>
<p><label for="descrizione" class="top">descrizione del sito</label><br />
</fieldset>
</div>
</td>
<td class="colonna login" width="900px" align="center">
<h1 class="title">Registrazione</h1>
<div class="modulo">
  <form method="post" action="index.php">
              <p><label for="username" class="top">Nome utente:</label><br />
                  <input type="text" name="username" id="username" tabindex="15" class="field" value="" />
              </p>
              <p><label for="password" class="top">Password:</label><br />
                  <input type="password" name="password" id="password" tabindex="15" class="field" value="" />
              </p>
              <p><label for="email" class="top">Email:</label><br />
                  <input type="text" name="email" id="email" tabindex="15" class="field" value="" />
              </p>
              <p><label for="foto_profilo" class="top">Inserisci una foto profilo:</label><br />
                  <input type="file" name="foto_profilo" id="foto_profilo" class="field" value="">
              <p><input type="hidden" name="controller" value="registrazione" />
              <p><input type="hidden" name="task" value="salva" />
              <p><input type="submit" name="registrazione" class="button" value="Registrazione"  />
              </p>
  </form>
<h1 class="title">Login</h1>
<form method="post" action="index.php">
              <p><label for="username" class="top">Nome utente:</label><br />
                  <input type="text" name="username" id="username" tabindex="15" class="field" value="" />
              </p>
              <p><label for="password" class="top">Password:</label><br />
                  <input type="password" name="password" id="password" tabindex="15" class="field" value="" />
              </p>
              <p><input type="checkbox" name="checkbox" id="checkbox" class="checkbox" tabindex="15" size="1" value="" />
              <p><input type="hidden" name="controller" value="login" />
              <p><input type="hidden" name="task" value="autentica" />
              <p><input type="submit" name="login" class="button" value="Login"  />
              </p>
</form>
</div>
</td>
</tr>
</table>