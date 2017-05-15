<?php /* Smarty version 2.6.30, created on 2017-05-15 18:11:53
         compiled from ShowPhotoUser.tpl */ ?>

<!-- può essere fatto un solo template sfruttando foto altri user -->
<div class="container">
    <div class="row">
    <div class="col-md-6">
                    <p><h3 class="text-success">Titolo:</h3><br /></p>
                    <p><label for="Title"><?php echo $this->_tpl_vars['photo_deteils']['title']; ?>
</p> </br>
                    <p><img src="<?php echo $this->_tpl_vars['photo_deteils']['fullsize']; ?>
" width="300px" height="300px"></p>
                    <p><h3 class="text-success">Like:</h3><?php echo $this->_tpl_vars['photo_deteils']['total_like']; ?>
<br /></p>
                    <form method="POST" action="index.php">
                        <?php if ($this->_tpl_vars['attiva'] == 'TRUE'): ?><!-- serve per attivare i like -->
                        <p><input type="hidden" name="controller" value="Like" />
                           <input type="hidden" name="task" value="Add_like" />
                           <input type="submit" name="like" class="btn-success" value="Mi Piace"  /></p>
                        <?php else: ?>
                        <p><input type="hidden" name="controller" value="Like" />
                           <input type="hidden" name="task" value="Remove_like" />
                           <input type="submit" name="like" class="btn-success" value="Non Mi Piace Pi&ugrave;"  /></p>
                        <?php endif; ?>
                    </form>
                    <?php if ($this->_tpl_vars['photo_deteils']['username'] == $this->_tpl_vars['user_details']['username']): ?>
                    <form method="POST" action="index.php">
                        <p><input type="hidden" name="controller" value="photo" />
                        <p><input type="hidden" name="task" value="modifca" />
                        <p><input type="hidden" name="id" value="<?php echo $this->_tpl_vars['photo_deteils']['id']; ?>
" />
                        <p><input type="submit" name="modifica" class="btn-success" value="Modifica"  /></p>
                    </form>
                    <?php endif; ?>
                    
    </div>
    <div class="col-md-6">
                    <p><h3 class="text-success">Descrizione:</h3><br /><?php echo $this->_tpl_vars['photo_deteils']['description']; ?>
</p>
                    <p><h3 class="text-success">Riservata:</h3><br /><?php echo $this->_tpl_vars['photo_deteils']['is_reserved']; ?>
</p>   
                    <p><h3 class="text-success">Categoria:</h3><br /><?php echo $this->_tpl_vars['photo_deteils']['categories']; ?>
</p>
                    <p><h3 class="text-success">Data di pubblicazione:</h3><?php echo $this->_tpl_vars['photo_deteils']['upload_date']; ?>
<br /></p>
                    <p><h3 class="text-success">Album di appartenenza:</h3><?php echo $this->_tpl_vars['photo_deteils']['name_album']; ?>
<br /></p>

    
                    <form method="post" action="index.php">
                        <p><h3 class="text-success">Commento:</h3><br />
                           <textarea name="commento"rows="4" cols="50">.....</textarea>
                           <p><input type="hidden" name="controller" value="commento" />
                           <p><input type="hidden" name="task" value="inserisci" />
                           <p><input type="submit" name="modifica" class="btn-success" value="Commenta"  /></p>
                  </form>
    </div>
    </div>
</div>
<!-- come mettere i commenti già esistenti -->