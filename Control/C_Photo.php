<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Photo
{
    public function Upload_foto()
    {
        $session = new \Utilities\U_Session;
        $username = $session->get_val('username');
        $v_Upload = new \View\V_Upload;
        $dati_foto = $v_Upload->get_Dati();
        $title = $dati_foto['title'];
        $desc = $dati_foto['desc'];
        $is_Reserved = $dati_foto['is_Reserved'];
        $cat = $dati_foto['cat'];
        $foto = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
        $this->controllaFoto();
        $photo_details=array(
                'type' => $_FILES['foto_Utente']['type'],
                'size' => $_FILES['foto_Utente']['size'],
                'immagine' => file_get_contents($_FILES['foto_utente']['tmp_name']));
        //$immagine = addslashes ($immagine);
        \Foundation\F_Photo::insert($foto, $photo_details, $username);
    }

    public function controllaFoto()
    {
        //fare con eccezioni al posto dei return false e true
        if($_FILES['foto_Utente']['error'] !== 0)
        {
            return FALSE;
        }
        elseif($_FILES['foto_Utente']['type'] !== 'image/jpeg' 
            && $_FILES['foto_Utente']['type'] !== 'image/png')
        {
            return FALSE;
        }
        elseif($_FILES["foto_Utente"]['size'] > MAX_SIZE)
        {
            return FALSE;
        }
        return TRUE;
    }


}