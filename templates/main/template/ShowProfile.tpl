<div class="container">
    <div class="row">
    <div class="col-md-6">
			<table>
                            {foreach from=$thumbnail item=array1}
                                <tr>
                                    {foreach from=$array1 item=valore}
                                        <td>
                                        <img src="{$valore}" width="114" height="75" class="img-responsive" > 
                                        </td>
                                    {/foreach}
                                </tr>
                            {/foreach}
                        </table> 
    </div>
    <div class="col-md-6">
			<img src="{$pic_profile}" class="thumbnail">
			<h3 class="text-success">Username:</h3><br />{$user_details.username}
                        <h3 class="text-success">Email:</h3><br />{$user_details.email}
                        <h3 class="text-success">Ruolo:</h3><br />{$role}
			
                        <form method="post" action="index.php">  
                            <p><input type="hidden" name="controller" value="profilo" />
                         <input type="hidden"  name="username" value="{$user_details.username}">
                         <input type="hidden" name="email" value"{$user_details.email}">
                         <input type="hidden" name="role" value"{$user_details.role}">
                         <input type="hidden" name="task" value="modifica" />
                         <input type="submit" name="Modifica" class="btn-success" value="Modifica Profilo"/></p>
                        </form>	
    </div>
    </div>                     
</div> 