<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Control;

class C_Profilo
{
    /**
     * 
     * mostra il profilo di un utente in cui è possibile visualizzare 
     * la foto profilo i dati(nome user, email, ruolo) e gli album;
     */
    public function display_user()
    {

        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_UserDetails($username);
        $array_post = $V_Profilo->getdati('username', 'page_toView', 'page_tot', 'order');
        $page_toView = $array_post['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        $order = $array_post['order'];
        if($order == NULL)
        {
            $order = FALSE;
        }
        $array_album = \Foundation\F_Photo::get_By_User($username, $page_toView, $order_DESC);
        if($array_album['photo_tot'] !== 0)
        {
            $page_tot = ceil($array_album['photo_tot'] / PHOTOS_PER_PAGE);
            $V_Profilo->assign('page_tot', $page_tot);
            $V_Profilo->assign('id_thumbnail', $array_album['id']);
            $V_Profilo->assign('page_toView', $page_toView);
            $V_Profilo->assign('thumbnail', $array_album['thumbnail']);
        }
        else
        {
            $V_Profilo->assign('message', "Nessuna foto Caricata");
        }
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $user_datails["photo"]); //CONTROLLA SE IMPLEMENTATA IN FOUNDATION
        return $V_Profilo->fetch('profilo_riepilogo.tpl');
    }


    /**
     * 
     * mostra il profilo di un utente in cui è possibile visualizzare 
     * la foto profilo i dati(nome user, email, ruolo) e gli album;
     */
    public function display_user_album()
    {

        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_UserDetails($username);
        $array_post = $V_Profilo->getdati();
        $page_toView = $array_post['page_toView'];
        if($page_toView == NULL)
        {
            $page_toView = 1;
        }
        $order = $array_post['order'];
        if($order == NULL)
        {
            $order = FALSE;
        }
        $array_album = \Foundation\F_Album::get_By_User($username, $page_toView, $order);
        if($array_album['tot_album'])
        {
            $page_tot = ceil($array_album['tot_album'] / PHOTOS_PER_PAGE);
            $V_Profilo->assign('page_tot', $page_tot);
            $V_Profilo->assign('id_thumbnail', $array_album['id']);
            $V_Profilo->assign('thumbnail', $array_album['thumbnail']);
            $V_Profilo->assign('page_toView', $page_toView);
        }
        else
        {
            $V_Profilo->assign('message', "Nessun Album creato");
        }
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $user_datails["photo"]); //CONTROLLA SE IMPLEMENTATA IN FOUNDATION
        return $V_Profilo->fetch('profilo_riepilogo.tpl');
    }


    /**
     * ritorna il tpl per la modifica dei dati
     */
    public function modifica_dati_utente()
    {
        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_UserDetails($username);
        $V_Profilo->assign('utente', $user_details);
        $foto_profilo = \Foundation\F_User::get_ProfilePic($username);
        $V_Profilo->assign('foto_profilo', $foto_profilo);
        $V_Profilo->assign('utente', $user_details);
        return $V_Profilo->fetch('modifica profilo.tpl');
    }


    /**
     * update dei dati dati dell'utente
     */
    public function update_dati_utente()
    {
        $V_Profilo = new \View\V_Profilo;
        $dati = $V_Profilo->get_Dati();
        $new_username = $dati['username'];
        $new_password = $dati['password'];
        $new_email = $dati['email'];
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        try
        {
            $new_details = new \Entity\E_User($new_username, $new_password, $new_email);
        }
        catch (\Exceptions\input_texts $ex)
        {
            //Primo catch: gestire username non validi
            $view->assign('messaggio', $ex->getMessage());
            $this->modulo_registrazione();
        }
        catch (\Exceptions\InvalidInput $ex)
        {
            //Primo catch: gestire username non validi
            $view->assign('messaggio', $ex->getMessage());
            $this->modulo_registrazione();
        }

        \Foundation\F_User::update_details($new_details, $old_Username);
        $this->riepilogo_dati();
    }


    /**
     * modifica la foto del profilo
     */
    public function update_profile_pic()
    {
        $v_Profilo = new \View\V_Profilo;
        $dati_foto = $v_Profilo->get_Dati();
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        try
        {
            $title = "immagine_profilo_".$username;
            $photo_details = new \Entity\E_Photo($title);
        }
        catch (\Exceptions\input_texts $ex)
        {
            //Catch per il titolo
            $v_foto->assign('messaggio', $ex->getMessage());
            $this->modulo_upload();
        }
        if($dati_foto['error'] == 0)
        {
            if($type == 'image/jpeg' && $type == 'image/jpg' && $type == 'image/png')
            {
                try
                {
                    try
                    {
                        $photo_blob = new \Entity\E_Photo_Blob();
                        $photo = $photo_blob->generate($dati_foto['tmp_name'], $dati_foto['size'], $dati_foto['type']);
                    }
                    catch (\Exceptions\photo_details $ex)
                    {
                        //Primo catch: Percorso immagine non valido
                        $v_foto->assign('messaggio', $ex->getMessage());
                        $this->modifica_profile_pic();
                    }
                }
                catch (\Exceptions\photo_details $ex)
                {
                    //Primo catch: Dimensione immagine troppo grande
                    $v_foto->assign('messaggio', $ex->getMessage());
                    $this->modifica_profile_pic();
                }
                //per immagine profilo
                \Foundation\F_User::remove_ProfilePic($username);
                \Foundation\F_Photo::insert($photo_details, $photo, $username);
                $profile_Pic_ID = $photo_details->get_ID();
                \Foundation\F_User::update_ProfilePic($username, $profile_Pic_ID);
                $this->display_user();
            }
            else
            {
                $v_foto->assign('messaggio', 'Formato errato, sono ammessi formati .jpg, .png, .jpeg. Riprova!');
                $this->modifica_profile_pic();
            }
        }
        else
        {
            $v_foto->assign('messaggio', 'Errone nel caricamento della foto. Riprova!');
            $this->modifica_profile_pic();
        }
    }


    /**
     * modulo per la modifica dell'immagine del profilo
     * @return type tpl
     */
    public function modifica_profile_pic()
    {
        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_UserDetails($username);
        $V_Profilo->assign('utente', $user_details);
        $foto_profilo = \Foundation\F_User::get_ProfilePic($username);
        $V_Profilo->assign('utente', $user_details);
        return $V_Profilo->fetch('modifica_foto_profilo.tpl');
    }


    /**
     * smista in base al task alle varie function 
     * @return tpl
     */
    public function smista()
    {
        $V_Profilo = new \View\V_Profilo();
        switch ($V_Profilo->getTask())
        {
            case 'riepilogo':
                return $this->display_user();
            case 'riepilogo album':
                return $this->display_user_album();
            case 'Modifica':
                return $this->modifica();
            case 'update':
                return $this->update_dati_utente();
            case 'modifca_pic':
                return $this->modifica_profile_pic();
            case 'update_pic':
                return $this->update_profile_pic();
        }
    }


}