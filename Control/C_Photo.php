<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Photo
{
    /**
     * ritorna il tpl per upload dei file
     * @return tpl
     */
    public function modulo_upload()
    {
        $V_Foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $V_Foto->assign('utente', $username);
        $array_user = \Foundation\F_User::get_UserDetails($username);
        $e_user = $array_user[0];
        $rolo = $e_user->get_Role();
        if($role == \Utilities\Roles::STANDARD)
        {
            return $V_Foto->display('upload_standard.tpl');
        }
        elseif($role > \Utilities\Roles::STANDARD)
        {
            return $V_Foto->display('upload.tpl');
        }
        else
        {
            $Session->unset_session();
        }
    }


    /**
     * ritorna il tpl per visualizzare una foto dopo aver cliccato su una thumbnail
     * @return tpl
     */
    public function display_photo()
    {
        $V_foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $V_foto->assign('username', $username);
        $id = $V_foto->get_Dati('id');
        $foto_details = \Foundation\F_Photo::get_By_ID($id);
        $photo = $foto_details[0];
        $categories = $foto_details[1];
        $user_like = $foto_details[2];
        $V_foto->assign('foto_deteils', $photo);
        $V_foto->assign('categories', $categories);
        $this->assegna_tasto($user_like, $V_foto, $username);
        $this->ridimensiona($fullsize, $V_foto);
        $array_user = \Foundation\F_User::get_UserDetails($username);
        $e_user = $array_user[0];
        $role = $e_user->get_Role();
        if($foto_details['username'] != $username)
        {
            if($role >= \Utilities\Roles::MOD)
            {
                return $V_foto->display('foto_altri_user_mod.tpl');
            }
            elseif($role == \Utilities\Roles::BANNED)
            {
                $Session->unset_session();
            }
            $V_foto->display('foto_altri_user.tpl');
        }
        elseif($role == \Utilities\Roles::BANNED)
        {
            $Session->unset_session();
        }
        $V_foto->display('foto_user.tpl');
    }


    /**
     * ridimensiona la foto per la visualizzazione
     * @param type $fullsize foto
     * @return array che contiene le nuove dimensioni
     */
    private function ridimensiona($fullsize, $V_foto)
    {
        $size = getimagesize($fullsize);
        $width = $size['width'];
        $height = $size['height'];
        if($width > $height)
        {
            $ratio = floor(FULL_WIDTH / $width);
            $width_new = $ratio * $width;
            $height_new = $ratio * $height;
            $V_foto->assign('width', $width_new);
            $V_foto->assign('height', $height_new);
        }
        $ratio = floor(FULL_WIDTH / $height);
        $width_new = $ratio * $width;
        $height_new = $ratio * $height;
        $V_foto->assign('width', $width_new);
        $V_foto->assign('height', $height_new);
    }


    /**
     * serve per impostare il tasto like e il numero di like di una foto
     * @param array $user_like contiene gli user che hanno messo il like alla foto
     * @param \View\V_Foto $V_foto
     * @param stirng $username
     */
    private function assegna_tasto($user_like, $V_foto, $username)
    {
        $total_like = count($user_like);
        $V_foto->assign('total_like', $total_like);
        if(in_array($username, $user_like))
        {
            $V_foto->assign('attiva', $attiva = TRUE);
        }
        else
        {
            $V_foto->assign('attiva', $attiva = FALSE);
        }
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
        $foto_details = $V_Foto->get_Dati('filesize', 'title', 'description', 'is_reserved', 'categories');
        $V_Foto->assign('dati_foto', $foto_details);
        $V_Foto->assign('utente', $username);
        return $V_Foto->display('modifica_foto.tpl');
    }


    /**
     * update dei dati dell'utente
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
        \Foundation\F_Photo::update($foto);
    }


    public function smista()
    {
        $V_Photo = new \View\V_Profilo();
        switch ($V_Photo->getTask())
        {
            case 'modulo_upload';
                return $this->modulo_upload();
                break;
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
