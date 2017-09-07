<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="text-success">Foto da mostrare</h1><br/>
            <img src={$foto}>
            <p><label for="descrizione">descrizione del sito</label><br />
        </div>
        <div class="col-md-6">
            <h1 class="text-success">Registrazione</h1>
            <form method="post" action="Service/loginregistration.php">
                <h3 class="text-success">Username:</h3><br />
                <div class="form-group">
                    <input id="username" name="username" class="form-control" type="text" value="" required="required" maxlength="20" pattern="[-._a-zA-Z0-9]+">
                </div>
                <h3 class="text-success">Password:</h3><br />
                <div class="form-group">
                    <input id="password" name="password" class="form-control" type="password" value="" required="required">
                </div>
                <h3 class="text-success">Ripeti Password:</h3><br />
                <div class="form-group">
                    <input id="ripetipassword" name="ripetipassword" class="form-control" type="password" value="" required="required">
                </div>
                <h3 class="text-success">Email:</h3><br />
                <div class="form-group">
                    <input id="email" name="email" class="form-control" type="email" value="" required="required">
                </div>
                <input type="hidden" name="action" value="registration"/>
                <button type="submit" name="Salva" class="btn btn-success">Registrati</button>
            </form>
        </div>
    </div>
</div>
<script src="templates/main/template/js/registration.js"></script>