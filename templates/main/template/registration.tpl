<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h1 class="text-success">Foto da mostrare</h1><br/>
			<div class="container">
                            {foreach from=$array_photo item=array1}
                            <div class="row">
                                {foreach from=$array1 item=valore}
                                    <div class="col-md-3">
                                        <img src="data:".{$valore.type}.";base64,'.base64_encode( {$valore.thumbanil} ).'">
                                        <!--modo per mettere gli id nascoti-->
                                    </div>
                                {/foreach}
                            </div>
                            {/foreach}
                        </div>
                        <p><label for="descrizione">descrizione del sito</label><br />
    </div>
    <div class="col-md-6">
                <h1 class="text-success">Registrazione</h1>
		<form metod="POST" action="index.php">
                            <h3 class="text-success">Username:</h3><br />
                            <div class="form-group">
                                <input name="username" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <h3 class="text-success">Password:</h3><br />
                            <div class="form-group">
                                <input name="password" class="form-control" id="focusedInput" type="password" value="">
                            </div>
                            <h3 class="text-success">Email:</h3><br />
                            <div class="form-group">
                                <input name="email" class="form-control" id="focusedInput" type="text" value="">
                            </div>
                            <input type="hidden" name="controller" value="profilo" /> <!-- in value ci andranno in seguito -->
                            <input type="hidden" name="task" value="update" />
                            <input type="submit" name="Salva" class="btn-success" value="Registrati"/>
                </form>
    </div>
    </div>
</div>
