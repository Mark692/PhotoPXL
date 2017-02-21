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
        $v_foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_foto->assign('utente', $username);
        $v_foto->assign('role', $role);
        $categorie = $v_foto->imposta_categoria();
        $v_foto->assign('categorie', $categorie);
        if($role == \Utilities\Roles::STANDARD)
        {
            return $v_foto->fetch('upload_standard.tpl');
        }
        elseif($role > \Utilities\Roles::STANDARD)
        {
            return $v_foto->fetch('upload.tpl');
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
        $v_foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $v_foto->assign('username', $username);
        $v_foto->assign('role', $role);
        $id = $v_foto->getID();
        $foto_details = \Foundation\F_Photo::get_By_ID($id);
        $photo = $foto_details[0];
        $cat = $foto_details[1];
        $user_like = $foto_details[2];
        $commenti= \Foundation\F_Comment::get_By_Photo($id);
        $commenti = $this->button_remove_comments($comments, $v_foto, $username, $role);
        $v_foto->assign('commenti', $commenti);
        $v_foto->assign('foto_deteils', $photo);
        $categories = $v_foto->imposta_categoria($cat);
        $v_foto->assign('categories', $categories);
        $this->button_like($user_like, $v_foto, $username);
        $this->ridimensiona($photo['fullsize'], $v_foto);
        if($foto_details['username'] != $username)
        {
            if($role >= \Utilities\Roles::MOD)
            {
                return $v_foto->fetch('foto_altri_user_mod.tpl');
            }
            elseif($role == \Utilities\Roles::BANNED)
            {
                $Session->unset_session();
            }
            $v_foto->fetch('foto_altri_user.tpl');
        }
        elseif($role == \Utilities\Roles::BANNED)
        {
            $Session->unset_session();
        }
        $v_foto->fetch('foto_user.tpl');
    }


    /**
     * ridimensiona la foto per la visualizzazione
     * @param type $fullsize foto
     * @param type $V_foto oggetto v_foto
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
     * @param \View\V_Foto $v_foto
     * @param stirng $username
     */
    private function button_like($user_like, $v_foto, $username)
    {
        $total_like = count($user_like);
        $v_foto->assign('total_like', $total_like);
        if(in_array($username, $user_like))
        {
            $v_foto->assign('attiva', $attiva = TRUE);
        }
        else
        {
            $v_foto->assign('attiva', $attiva = FALSE);
        }
    }


    /**
     * serve per impostare il tasto remove ai commenti
     * @param array $comments contiene gli user che hanno messo il like alla foto
     * @param \View\V_Foto $v_foto
     * @param stirng 
     */
    private function button_remove_comments($comments, $v_foto, $username, $role)
    {
        foreach($comments as $valore)
        {
            if(($username !== $valore["user"]) && ($role <= Utilities\Roles::PRO))
            {
                $add = array("attiva" => FALSE);
            }
            else
            {
                $add = array("attiva" => TRUE);
            }
            array_push($valore, $add);
        }
        return $comments;
    }


    /**
     * upload di una foto
     */
    public function Upload_foto()
    {
        $session = new \Utilities\U_Session;
        $username = $session->get_val('username');
        $v_foto = new \View\V_Foto();
        $user = \Foundation\F_User::get_UserDetails($username);
        if($user->can_Upload() === TRUE)
        {
            $keys1 = array('foto1', 'foto2', 'foto3');
            $errori = [];
//    $keys2= array ('title','desc','is_reserved','cat','album_ID','tmp_name','size','type');
            foreach($keys1 as $dato1)
            {
                $dati_foto = array_merge($_REQUEST[$dato1], $_FILES[$dato1]);
                if($dati_foto !== NULL)
                {
                    $errore = $this->save_photo($dati_foto);
                    if($errore === [])
                    {
                        \Foundation\F_Photo::insert($photo_details, $photo, $username);
                        \Foundation\F_Photo::move_To($album_ID, $photo_ID);
                    }
                    else
                    {
                        array_push($errori[$dato1], $errore);
                    }
                }
            }
            if($errori !== [])
            {
                $v_foto->assign('messaggio', $errori); //foreach su smarty
                $this->modulo_upload();
            }
            if($user->getRole() === \Utilities\Roles::STANDARD)
            {
                $user->add_up_Count();
                $user->set_Last_Upload(time());
                \Foundation\F_User_Standard::update_Counters($user);
            }
            $c_profilo = new \Control\C_Profilo();
            return $c_profilo->display_user();
        }
        else
        {
            $v_foto->assign('messaggio', 'Il limite è stato superato');
            return $v_foto->fetch('template_diventa_pro');
        }
    }


    /**
     * funzione per il controlo degli errori durante il caricamento di una foto
     * @param type $dati_foto
     * @return type array
     */
    private function error_photo($dati_foto)
    {
        $title = $dati_foto['title'];
        $desc = $dati_foto['desc'];
        $is_Reserved = $dati_foto['is_Reserved'];
        $cat = $dati_foto['cat'];
        $categorie = $v_foto->reimposta_categorie($cat);
        $album_ID = $dati_foto['album_ID'];
        try
        {
            $photo_details = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
        }
        catch(\Exceptions\input_texts $ex)
        {
            //Catch per il titolo
            array_push($errore, $ex->getMessage());
        }
        $type = $dati_foto['type'];
        $size = $dati_foto['size'];
        $path = $dati_foto['tmp_name'];
        if($dati_foto['error'] == 0)
        {
            if($type == 'image/jpeg' && $type == 'image/jpg' && $type == 'image/png')
            {
                try
                {
                    try
                    {
                        $photo_blob = new \Entity\E_Photo_Blob();
                        $photo = $photo_blob->generate($path, $size, $type);
                    }
                    catch(\Exceptions\photo_details $ex)
                    {
                        //Primo catch: Percorso immagine non valido
                        array_push($errore, $ex->getMessage());
                    }
                }
                catch(\Exceptions\photo_details $ex)
                {
                    //Secondo catch: Dimensione immagine troppo grande
                    array_push($errore, $ex->getMessage());
                }
            }
            else
            {
                array_push($errore, 'Formato errato, sono ammessi formati .jpg, .png, .jpeg. Riprova!');
            }
        }
        else
        {
            array_push($errore, 'Errone nel caricamento della foto. Riprova!');
        }
        return $errore;
    }


    /**
     * ritorna il tpl per la modifica dei dati della foto
     */
    public function modifica()
    {
        $v_foto = new \View\V_Foto;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $role = $Session->get_val('role');
        $id = $v_foto->getID();
//        $album = \Foundation\F_Album::;//funzione per riotnare id e titolo album;
        $foto = \Foundation\F_Photo::get_By_ID($id);
        $v_foto->assign('username', $username);
        $v_foto->assign('role', $role);
        $v_foto->imposta_categoria($foto['categories']);
        $v_foto->assign('dati_foto', $foto);
        $v_foto->assign('album', $album);
        if($role > \Utilities\Roles::STANDARD)
        {
            return $v_foto->fetch('modifica_foto_pro.tpl');
        }
        return $v_foto->fetch('modifica_foto.tpl');
    }


    /**
     * update dei dati della foto
     */
    public function update()
    {
        $V_Foto = new \View\V_Foto;
        $dati_foto = $V_Foto->get_Dati();
        $id = $V_Foto->getID();
        $title = $dati_foto['title'];
        $desc = $dati_foto['desc'];
        $is_Reserved = $dati_foto['is_Reserved'];
        $cat = $dati_foto['cat'];
        $categories = $V_Foto->reimposta_categorie($cat);
        $album_ID = $dati_foto['album_ID'];
        try
        {
            $photo_details = new \Entity\E_Photo($title, $desc, $is_Reserved, $cat);
        }
        catch(\Exceptions\input_texts $ex)
        {
            //Catch per il titolo
            $V_Foto->assign('messaggio', $ex->getMessage());
            $V_Foto->assign('id', $id);
            return $this->modifica();
        }
        $foto->set_ID($id);
        \Foundation\F_Photo::update($foto);
        \Foundation\F_Photo::move_To($album_ID, $photo_ID);
        return $this->display_photo();
    }


    /**
     * funzione per elimanre una foto
     */
    public function delete_foto()
    {
        $V_Foto = new \View\V_Foto;
        $id = $V_Foto->getID();
        \Foundation\F_Photo::delete($id);
        $c_profilo = new \Control\C_Profilo();
        return $c_profilo->display_user();
    }


    public function smista()
    {
        $V_Photo = new \View\V_Foto();
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
            case 'update':
                return $this->update();
        }
    }


}
