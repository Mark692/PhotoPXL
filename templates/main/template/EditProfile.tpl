<div class="container">
    <div class="row">
        <div class="col-md-6">
            {if $no_result|default:"FALSE" eq "FALSE"}
                <div class="container">
                    {foreach from=$array_photo item=array1}
                        <div class="row">
                            {foreach from=$array1 item=valore}
                                <div class="col-sm-1">
                                    <a href="ShowProfile.tpl"></a>
                                    {$valore}
                                    <!--modo per mettere gli id nascoti-->
                                </div>
                            {/foreach}
                        </div>
                    {/foreach}
                </div>
            {else}
                <h3 class="text-success">{$no_result}</h3>
            {/if}
        </div>
        <div class="col-md-6">
            <form method="POST" action="Service/profileSync.php">
                {$pic_profile}
                <h3 class="text-success">Username:</h3><br />
                <div class="form-group">
                    <input id="username" name="username" class="form-control" type="text" value="{$user_details.username}" maxlength="20" pattern="[-._a-zA-Z0-9]+">
                </div>
                <h3 class="text-success">Password:</h3><br />
                <div class="form-group">
                    <input id="password" name="password" class="form-control" type="password" >
                </div>
                <h3 class="text-success">Email:</h3><br />
                <div class="form-group">
                    <input name="email" class="form-control" type="email" value="{$user_details.email}">
                </div>
                <h3 class="text-success">Ruolo:</h3><br />{$user_details.role}
                <input type="hidden" name="action" value="edit" />
                <input type="submit" name="Salva" class="btn btn-success" value="Salva Modifiche"/>
            </form>
        </div>
    </div>
</div>
<script src="templates/main/template/js/edit_profile.js"></script>