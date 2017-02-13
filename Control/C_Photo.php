<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Photo
{
    public function display_photo()
    {

        $V_foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $id = $V_foto->get_Dati('id');
        $foto_details = \Foundation\F_Photo::get_By_ID($id);
        $V_foto->assign('foto_datails', $foto_details);
        $V_foto->assign('username', $username);
        return $V_foto->display('mostra_foto.tpl');
    }


    /**
     * upload di foto
     */
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
        $photo_details = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
        $this->controllaFoto();
        $type = $_FILES['foto_Utente']['type'];
        $size = $_FILES['foto_Utente']['size'];
        $photo_blob = file_get_contents($_FILES['foto_utente']['tmp_name']);
        $photo_blob = addslashes ($photo_blob);
        $photo = new \Entity\E_Photo_Blob($photo_blob,$type,$size); //controlla se va bene qunado si rifa il pull
        \Foundation\F_Photo::insert($photo_details, $photo, $username);
        //ritorna un template successo
    }


    /**
     * metto i try e cath in entity Photo_blob
     * controlla se il file inviato tramite form è adatto
     * @return boolean
     */
    public function controllaFoto()
    {
        //fare con eccezioni al posto dei return false e true
        if($_FILES['foto_Utente']['error'] !== 0)
        {
            return FALSE;
        }
        elseif($_FILES['foto_Utente']['type'] !== 'image/jpeg' && $_FILES['foto_Utente']['type'] !== 'image/png')
        {
            return FALSE;
        }
        elseif($_FILES["foto_Utente"]['size'] > MAX_SIZE)
        {
            return FALSE;
        }
        return TRUE;
    }


    /**
     * ritorna il tpl per la modifica dei dati della foto
     */
    public function modifica()
    {
        $V_Foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $foto_details = $V_Profilo->get_Dati('filesize', 'title', 'description', 'is_reserved', 'categories');
        $V_foto->assign('dati_foto', $user_datails);
        $V_Foto->assign('utente', $username);
        return $V_Profilo->display('modifica_foto.tpl');
    }


    /**
     * update dei dati dati dell'utente
     */
    public function update()
    {
        $V_Foto = new \View\V_Foto;
        $dati_foto = $V_Foto->get_Dati();
        $title = $dati_foto['title'];
        $desc = $dati_foto['desc'];
        $is_Reserved = $dati_foto['is_Reserved'];
        $cat = $dati_foto['cat'];
        $foto = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
    }


}