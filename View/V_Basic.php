<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

require('libs/Smarty.class.php');

class V_Basic extends \Smarty
{
    /**
     * Costruttore della classe
     */
    public function __construct()
    {
//        $this->smarty();
        global $config;
//        $this->Smarty();
        $this->template_dir = $config['smarty']['template_dir'];  //L'insieme di queste assegnazioni
        $this->compile_dir = $config['smarty']['compile_dir'];   //serve all'oggetto Smarty per
        $this->config_dir = $config['smarty']['config_dir'];    //conoscere la posizione di alcune
        $this->cache_dir = $config['smarty']['cache_dir'];     //cartelle usate dal programma
        $this->caching = false;
    }


    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     * @param string or array $keys Description chiavi usate per cercare
     * @return array
     */
    public function get_Dati($keys)
    {
        $total = array_merge($_REQUEST, $_FILES);
        foreach($keys as $dato)
        {
            $dettagli[$dato] = $total[$dato];
        }
        return $dettagli;
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getID()
    {
        if(isset($_REQUEST['id']))
        {
            return $_REQUEST['id'];
        }
    }


    /**
     * Questa funzione, restituisce il task inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getTask()
    {
        if(isset($_REQUEST['task']))
        {
            return $_REQUEST['task'];
        }
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        if(isset($_REQUEST['controller']))
        {
            return $_REQUEST['controller'];
        }
//        return FALSE;
    }


    /**
     * Ritorna il contenuto del template che si vuole visualizzare
     * Questa funzione va sovrascritta nelle classi figlie impostando $nome_template
     *
     * @return tpl content
     */
    public function processa_Template($nome_template)
    {
        $contenuto = $this->fetch($nome_template.'.tpl');
        return $contenuto;
    }


    /**
     * Assegna a smarty i dati della registrazione passati come parametro
     *
     * @param array $dati
     * @param int $data
     */
    public function set_Dati($dati)
    {
        $this->assign('username', $dati['username']);
        $this->assign('email', $dati['email']);
    }


    /**
     * 
     * @param type $role
     */
    public function imposta_ruolo($role)
    {
        switch ($role)
        {
            case \Utilities\Roles::BANNED:
                return $ruolo = "bannato";

            case \Utilities\Roles::STANDARD:
                return $ruolo = "standard";

            case \Utilities\Roles::PRO:
                return $ruolo = "pro";

            case \Utilities\Roles::MOD:
                return $ruolo = "mod";

            case \Utilities\Roles::ADMIN:
                return $ruolo = "admin";

            default : return $ruolo = "ospite";
        }
    }


    /**
     * dal valore numerico mi ritorna un array con scritte
     * @param type $categories
     * @return array
     */
    public function imposta_categoria($categories = [1, 2, 3, 4, 5, 6, 7, 8])
    {
        $cost = [];
        foreach($categories as $valore)
        {

            switch ($valore)
            {
                case \Utilities\Roles::BANNED:
                    $categoria = "bannato";
                    break;

                case \Utilities\Roles::STANDARD:
                    $categoria = "standard";
                    break;

                case \Utilities\Roles::PRO:
                    $categoria = "pro";
                    break;

                case \Utilities\Roles::MOD:
                    $categoria = "mod";
                    break;

                case \Utilities\Roles::ADMIN:
                    $categoria = "admin";
                    break;
            }
            array_push($cost, $categoria);
        }
        return $cost;
    }


    /**
     * trasforma le stringe in numeri per le categorie
     */
    public function reimposta_categorie($categories)
    {
        $cost = [];
        foreach($categories as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }


}