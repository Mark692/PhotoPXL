<div class="container">
    <div class="row">
    <div class="col-md-6">
        <h1 class="text-success">Foto da mostrare</h1><br/>
            <img src={$foto}>
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
