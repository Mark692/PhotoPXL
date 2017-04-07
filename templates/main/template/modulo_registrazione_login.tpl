<table>
<tr>
    <td>
<div id="page">
    <table>
        <tr>
            <td class="contain" align="center">
        <div class="foto">
            <h3>Foto da mostrare</h3><br/>
                 <table>
                            {foreach from=$thumbnail item=array1}
                                <tr>
                                {foreach from=$array1 item=valore}
                                    <td>
                                <img src={$valore} width="100" height="100" > 
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
        <td class="contain" align="center">
            <div class="modulo">
                <h2>Registrazione</h2>
                <form method="post" action="prova.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="email" class="top">Email:</label><br />
                          <input type="text" name="email" class="input" tabindex="15" class="field" value="" /></p>
                      <p><input type="hidden" name="controller" value="registrazione" />
                          <input type="hidden" name="task" value="salva" />
                          <input type="submit" name="registrazione" class="button" value="Registrazione"  /></p>
                </form>
                <h2>Login</h2>
                <form method="post" action="index.php">
                      <p><label for="username" class="top">Nome utente:</label><br />
                          <input type="text" name="username" class="input" tabindex="15" class="field" value="" /></p>
                      <p><label for="password" class="top">Password:</label><br />
                          <input type="password" name="password" class="input" tabindex="15" class="field" value="" /></p>
                      <p><input type="hidden" name="controller" value="login" />
                         <input type="hidden" name="task" value="autentica" />
                         <input type="submit" name="login" class="button" value="Login"  /></p>
                </form>
            </div>
        </td>
    </tr>
</table>