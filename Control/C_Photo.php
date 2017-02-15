<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Photo
{   
    public function modulo_upload()
    {
        $V_Foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $V_Foto->assign('utente', $username);
        $user=\Foundation\F_User::get_By_Username($username);
        if($user['role']==1){
        return $V_Foto->display('upload_standard.tpl');
        }
        else {
        return $V_Foto->display('upload.tpl');
        }
    }
    
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
        try
        {
            $photo_details = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
        }
        catch (\Exceptions\input_texts $ex)
        {
            //Primo catch: gestire username non validi
            $view->assign('messaggio', $ex->getMessage());
            $this->modulo_upload();
        }
        $type = $dati_foto['type'];
        $size = $dati_foto['size'];
        $photo_blob = addslashes(file_get_contents($dati_foto['tmp_name']));
        if($dati_foto['error'] == 0)
        {
            try
            {
                $photo = new \Entity\E_Photo_Blob($photo_blob, $size, $type);
            }
            catch (\Exceptions\photo_details $ex)
            {
                //Primo catch: gestire username non validi
                $view->assign('messaggio', $ex->getMessage());
                $this->modulo_upload();
            }
            catch (\Exceptions\photo_details $ex)
            {
                //Primo catch: gestire username non validi
                $view->assign('messaggio', $ex->getMessage());
                $this->modulo_upload();
            }
            catch (\Exceptions\photo_details $ex)
            {
                //Primo catch: gestire username non validi
                $view->assign('messaggio', $ex->getMessage());
                $this->modulo_upload();
            }
            \Foundation\F_Photo::insert($photo_details, $photo, $username);
        }
        else
        {
            $view->assign('messaggio', 'Errone nel caricamento della foto. Riprova!');
            $this->modulo_upload();
        }
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


    public function smista()
    {
        $V_Photo = new \View\V_Profilo();
        switch ($V_Photo->getTask())
        {
            case 'display':
                return $this->display_photo();
                break;
            case 'upload':
                $this->Upload_foto();
                break;
            case 'modifica':
                return $this->modifica();
                break;
            case 'update':
                return $this->update();
                break;
        }
    }


}