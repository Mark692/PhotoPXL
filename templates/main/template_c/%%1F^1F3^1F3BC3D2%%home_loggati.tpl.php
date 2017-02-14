<?php /* Smarty version 2.6.30, created on 2017-02-14 12:13:09
         compiled from home_loggati.tpl */ ?>
<table class="tabella"  align="center" border="3" cellpadding="5" cellspacing="0"
    <tr>
	<td class="colonna foto">
		<table class="tabella" width="900px" align="center" cellpadding="5" cellspacing="0">
                    		</table>
	</td>
	<td class="colonna ricerca" width="900px">
            <div class="metodo">
		<form method="POST" action="index.php">
                    <h3 class="title">Ricerca per categoria</h3>
                        <p><label for="Categories" class="top">Categoria</label><br />
                                                <p><input type="hidden" name="controller" value="ricerca" />
                            <input type="hidden" name="task" value="carca" />
                            <input type="submit" name="cerca" class="button" value="Inizia a Cercare"  /></p>
            </div>
	</td>
    </tr>
</table>