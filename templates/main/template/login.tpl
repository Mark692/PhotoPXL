<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="templates/main/template/img/noimagefound.jpg" width="300" >
            <p><label for="descrizione">descrizione del sito</label><br />
        </div>
        <div class="col-md-6">
            <h1 class="text-success">Login</h1>
            <form method="post" action="Service/loginregistration.php">
                <h3 class="text-success">Username:</h3><br />
                <div class="form-group">
                    <input id="username" name="username" class="form-control" type="text" value="">
                </div>
                <h3 class="text-success">Password:</h3><br />
                <div class="form-group">
                    <input id="password" name="password" class="form-control" type="password" value="">
                </div>
                <input type="hidden" name="action" value="login"/>
                <input type="submit" id="login" class="btn btn-success" value="Login"  />
            </form>
        </div>
    </div>
</div>
<script src="templates/main/template/js/login.js"></script>