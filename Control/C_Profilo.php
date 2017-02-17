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
    public function riepilogo_dati()
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
        $array_album = \Foundation\F_Album::get_By_User($username, $page_toView, $order);
        $page_tot= ceil($array_album['photo_tot']/PHOTOS_PER_PAGE);
        $V_Profilo->assign('page_tot', $page_tot);
        $V_Profilo->assign('id_thumbnail', $array_album['id']);
        $V_Profilo->assign('thumbnail', $array_album['thumbnail']);
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $user_datails["photo"]); //CONTROLLA SE IMPLEMENTATA IN FOUNDATION
        return $V_Profilo->fetch('profilo_riepilogo.tpl');
    }


    /**
     * ritorna il tpl per la modifica dei dati
     */
    public function modifica_dati()
    {
        $V_Profilo = new \View\V_Profilo;
        $user_details = $V_Profilo->get_Dati('username', 'email');
        $V_Profilo->assign('utente', $user_details);
        //recupero foto profilo
        $V_Profilo->assign('foto_profilo', $user_details['photo']);
        $V_Profilo->assign('utente', $user_details);
        $V_Profilo->assign('foto_profilo', $fotoprofilo);

        return $V_Profilo->fetch('modifica profilo.tpl');
    }

    /**
     * update dei dati dati dell'utente
     */
    public function update()
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
            $view->assign('messaggio',$ex->getMessage());
            $this->modulo_registrazione();
            }
        catch (\Exceptions\InvalidInput $ex)
            {
            //Primo catch: gestire username non validi
            $view->assign('messaggio',$ex->getMessage());
            $this->modulo_registrazione();
            
            }
        
            \Foundation\F_User::update_details($new_details, $old_Username);
            $this->riepilogo_dati();

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
                return $this->riepilogo_dati();
                break;
            case 'Modifica':
                return $this->modifica();
                break;
            case 'update':
                return $this->update();
                break;
        }
    }


}