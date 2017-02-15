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
     * la foto profilo i dati(nome user, email, ruolo) e le ultime 16 foto;
     */
    public function riepilogo_dati()
    {

        $V_Profilo = new \View\V_Profilo;
        $Session = new \Utilities\U_Session;
        $username = $Session->get_val('username');
        $user_datails = \Foundation\F_User::get_By_Username($username);
        $array_thumbnail = \Foundation\F_Photo::get_By_User($username);
        $id=$array_thumbnail["id"];
        $ultime_foto = $QUALCOSA_DA_SISTEMARE1->display_foto($array_thumbnail["thumbnail"]);
        //recupero foto profilo
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('id', $id);
        $V_Profilo->assign('foto_profilo', $user_datails["photo"]); //CONTROLLA SE IMPLEMENTATA IN FOUNDATION
        $V_Profilo->assign('array_ultime_foto', $ultime_foto);
        return $V_Profilo->display('profilo_riepilogo.tpl');
    }


    /**
     * ritorna il tpl per la modifica dei dati
     */
    public function modifica()
    {
        $V_Profilo = new \View\V_Profilo;
        $user_details = $V_Profilo->get_Dati('username', 'email');
        $V_Profilo->assign('utente', $user_datails);
        //recupero foto profilo
        $V_Profilo->assign('foto_profilo', $userdatails['photo']);
        $V_Profilo->assign('utente', $user_datails);
        $V_Profilo->assign('foto_profilo', $fotoprofilo);

        return $V_Profilo->display('modifica profilo.tpl');
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
    }
        
     
        //ritornerà un tpl di avvenuto successo
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
            case 'salva':
                return $this->update();
                break;
        }
    }


}