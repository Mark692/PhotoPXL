<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use Smarty;
use Utilities\Categories;
use Utilities\Roles;

class V_Basic extends Smarty
{
    /**
     * Costruttore della classe
     */
    public function __construct()
    {
        global $config;
        parent::__construct();
        $this->setTemplateDir($config['smarty']['template_dir']);
        $this->setCompileDir($config['smarty']['compile_dir']);
        $this->setCacheDir($config['smarty']['config_dir']);
        $this->setConfigDir($config['smarty']['cache_dir']);
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
    public function fetch_Template($nome_template)
    {
        $smarty = new Smarty();
        $contenuto = $smarty->fetch($nome_template.'.tpl');
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
        $smarty = new Smarty();
        $smarty->assign('username', $dati['username']);
        $smarty->assign('email', $dati['email']);
    }


    /**
     * dal valore numerico mi ritorna un array con stringhe
     * @param type $role
     * @return array
     */
    public function imposta_ruolo($role)
    {
        switch ($role)
        {
            case Roles::BANNED:
                $role = "bannato";
                break;

            case Roles::STANDARD:
                $role = "standard";
                break;

            case Roles::PRO:
                $role = "pro";
                break;

            case Roles::MOD:
                $role = "mod";
                break;

            case Roles::ADMIN:
                $role = "admin";
                break;
            default :
                $role = "ospite";
        }
        return $role;
    }


    /**
     * trasforma le stringe in numeri per i ruoli
     * @param array $role
     * @return array
     */
    public function reimposta_ruolo($role)
    {
        $cost = [];
        foreach($role as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }


    /**
     * dal valore numerico mi ritorna un array con scritte
     * @param array $categories
     * @return array
     */
    public function imposta_categoria($categories = [1, 2, 3, 4, 5, 6, 7, 8])
    {
        $cost = [];
        foreach($categories as $valore)
        {

            switch ($valore)
            {
                case Categories::PAESAGGI:
                    $categoria = "Paesaggi";
                    break;

                case Categories::RITRATTI:
                    $categoria = "Ritratti";
                    break;

                case Categories::FAUNA:
                    $categoria = "Fauna";
                    break;

                case Categories::BIANCONERO:
                    $categoria = "Bianco e Nero";
                    break;

                case Categories::ASTRONOMIA:
                    $categoria = "Astronomia";
                    break;
                case Categories::STREET:
                    $categoria = "Street";
                    break;
                case Categories::NATURAMORTA:
                    $categoria = "Natura Morta";
                    break;
                case Categories::SPORT:
                    $categoria = "Sport";
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


    /**
     * imposta i dati nel template identificati da una chiave ed il relativo valore
     * @param type $key
     * @param type $valore
     */
    public function impostaDati($key, $valore)
    {
        $smarty = new Smarty();
        $smarty->assign($key, $valore);
    }

    public function homecazzo()
    {
        $this->display('home_loggati.tpl');
    }


}
